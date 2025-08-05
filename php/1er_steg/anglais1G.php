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
$sql = "SELECT * FROM documents_college WHERE niveau = '3e' AND matiere = 'anglais' ORDER BY type_doc, date_ajout DESC";
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
    <title>Anglais 3e</title>
    <link rel="stylesheet" href="../../css/index.css"/>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        h1 { text-align: center; padding: 20px; background: #2c3e50; color: white; }
        .section { padding: 30px; }
        .section h2 { color: #2c3e50; }
        .doc-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .doc-title { font-size: 18px; margin-bottom: 5px; }
        .doc-meta { font-size: 14px; color: #555; }
        .doc-link {
            display: inline-block;
            margin-top: 10px;
            background:#2c3e50;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
        }
        .container { max-width: 800px; margin: auto; }
    </style>
</head>
<body>

    <h1>📘Anglais - Classe de 3e</h1>
    <div class="container">

        <?php foreach (['cours' => 'Cours', 'exercice' => 'Exercices', 'fascicule' => 'Fascicules'] as $type => $label): ?>
            <div class="section">
                <h2>📚 <?= $label ?></h2>
                <?php if (count($documents[$type]) === 0): ?>
                    <p>Aucun document disponible pour le moment.</p>
                <?php else: ?>
                    <?php foreach ($documents[$type] as $doc): ?>
                        <div class="doc-card">
                            <div class="doc-title"><?= htmlspecialchars($doc['titre']) ?></div>
                            <div class="doc-meta">👁️ <?= $doc['vues'] ?> vues</div>
                            <a class="doc-link" href="../view_doc.php?id=<?= $doc['id'] ?>" target="_blank">📖 Consulter</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    </div>
      <footer>
    <div class="footer-container">
      <div class="footer-section">
        <h4>À propos des auteurs</h4>
        <p>Ce site a été développé par une équipe passionnée d'informaticiens et d’enseignants pour aider les élèves et étudiants du monde francophone.</p>
      </div>
      <div class="footer-section">
        <h4>Contact</h4>
        <ul>
          <li>📞 Téléphone : +221 77 525 07 09</li>
          <li>📧 Email : contact@eduplus.com</li>
          <li>🌐 Site : www.eduplus.com</li>
        </ul>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 EduPlus. Tous droits réservés.</p>
      </div>
    </div>
  </footer>
</body>
</html>

<?php
$conn->close();
?>
