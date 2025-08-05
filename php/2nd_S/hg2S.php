<?php
// Connexion à la base de données
$host = 'localhost';
$user = 'root';
$pass = 'Keyassane1000';
$db = 'eduplus';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Requête : tous les documents de niveau 6e et matière math
$sql = "SELECT * FROM documents_college WHERE niveau = '2nds' AND matiere = 'hg' ORDER BY type_doc, date_ajout DESC";
$result = $conn->query($sql);

// Préparer les sections
$documents = [
    'cours' => [],
    'exercice' => [],
    'fascicule' => []
];

while ($row = $result->fetch_assoc()) {
    $documents[$row['type_doc']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Histoire-Géographie 2nd S - EduPlus</title>
    <link rel="stylesheet" href="../../css/footer.css"/>
    <link rel="stylesheet" href="../../css/header.css"/>
    <link rel="stylesheet" href="../../css/doc.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include '../footer/head.php'; ?>
    
    <main class="documents-container">
        <div class="page-header">
            <h1><i class="fas fa-book-open"></i> Histoire-Géographie - Classe de 2<sup>nd</sup>S</h1>
            <div class="breadcrumb">
                <span>Accueil</span> > <span>Collège</span> > <span>2<sup>nd</sup>S</span> > <span class="active">HG</span>
            </div>
        </div>

        <div class="documents-grid">
            <?php foreach (['cours' => 'Cours', 'exercice' => 'Exercices', 'fascicule' => 'Fascicules'] as $type => $label): ?>
                <section class="document-section">
                    <div class="section-header">
                        <h2><i class="fas <?= 
                            $type === 'cours' ? 'fa-chalkboard-teacher' : 
                            ($type === 'exercice' ? 'fa-pencil-alt' : 'fa-book') 
                        ?>"></i> <?= $label ?></h2>
                        <span class="badge"><?= count($documents[$type]) ?> documents</span>
                    </div>
                    
                    <?php if (count($documents[$type]) === 0): ?>
                        <div class="empty-state">
                            <i class="far fa-folder-open"></i>
                            <p>Aucun document disponible pour le moment</p>
                        </div>
                    <?php else: ?>
                        <div class="documents-list">
                            <?php foreach ($documents[$type] as $doc): ?>
                                <article class="document-card">
                                    <div class="card-header">
                                        <h3><?= htmlspecialchars($doc['titre']) ?></h3>
                                        <span class="doc-date"><?= date('d/m/Y', strtotime($doc['date_ajout'])) ?></span>
                                    </div>
                                    <div class="card-meta">
                                        <span><i class="far fa-eye"></i> <?= $doc['vues'] ?> vues</span>
                                        <span><i class="far fa-file-alt"></i> <?= strtoupper(pathinfo($doc['fichier_url'], PATHINFO_EXTENSION)) ?></span>
                                    </div>
                                    <div class="card-actions">
                                        <a href="../view_doc.php?id=<?= $doc['id'] ?>" class="btn preview-btn" target="_blank">
                                            <i class="far fa-eye"></i> Prévisualiser
                                        </a>
                         
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </section>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include '../footer/footer.php'; ?>
    
    <script>
        // Animation au chargement
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.document-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = 1;
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>