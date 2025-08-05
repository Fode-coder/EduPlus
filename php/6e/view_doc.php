<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'eduplus';
$user = 'root';
$pass = 'Keyassane1000';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification de l'ID du document
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../error.php?code=invalid_doc");
    exit();
}

$doc_id = intval($_GET['id']);

// Récupérer le document
try {
    $req = $pdo->prepare("SELECT * FROM documents_college WHERE id = ?");
    $req->execute([$doc_id]);
    $document = $req->fetch(PDO::FETCH_ASSOC);

    if (!$document) {
        header("Location: ../error.php?code=doc_not_found");
        exit();
    }

    // Incrémenter le nombre de vues
    $pdo->prepare("UPDATE documents_college SET vues = vues + 1 WHERE id = ?")->execute([$doc_id]);
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}

// Déterminer l'icône selon le type de document
$doc_icons = [
    'cours' => 'fa-chalkboard-teacher',
    'exercice' => 'fa-pencil-alt',
    'fascicule' => 'fa-book'
];
$doc_icon = $doc_icons[$document['type_doc']] ?? 'fa-file-alt';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($document['titre']) ?> | EduPlus</title>
    <link rel="stylesheet" href="../../css/viewer.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Correction du chemin PDF.js -->
    <script src="../js/pdf/build/pdf.js"></script>
    <script src="../js/pdf/build/pdf.worker.js"></script>
</head>
<body>
    <main class="document-viewer-container">
        <div class="document-header">
            <div class="breadcrumb">
                <a href="../../index.php">Accueil</a> > 
                <a href="../matieres.php?niveau=<?= urlencode($document['niveau']) ?>"><?= htmlspecialchars($document['niveau']) ?></a> > 
                <a href="../documents.php?matiere=<?= urlencode($document['matiere']) ?>"><?= htmlspecialchars($document['matiere']) ?></a> > 
                <span><?= htmlspecialchars($document['titre']) ?></span>
            </div>
            
            <h1><i class="fas <?= $doc_icon ?>"></i> <?= htmlspecialchars($document['titre']) ?></h1>
            
            <div class="document-meta">
                <span><i class="fas fa-eye"></i> <?= $document['vues'] + 1 ?> vues</span>
                <span><i class="fas fa-calendar-alt"></i> <?= date('d/m/Y', strtotime($document['date_ajout'])) ?></span>
                <span><i class="fas fa-file-pdf"></i> PDF</span>
                <span><i class="fas fa-tag"></i> <?= ucfirst($document['type_doc']) ?></span>
            </div>
        </div>

        <div class="document-actions">
            <a href="../../docs/<?= htmlspecialchars($document['fichier_url']) ?>" class="btn download-btn" download>
                <i class="fas fa-download"></i> Télécharger
            </a>
            <button id="print-btn" class="btn print-btn">
                <i class="fas fa-print"></i> Imprimer
            </button>
            <button id="fullscreen-btn" class="btn fullscreen-btn">
                <i class="fas fa-expand"></i> Plein écran
            </button>
        </div>

        <div class="pdf-viewer-container">
            <div class="pdf-controls">
                <button id="prev-page" class="control-btn"><i class="fas fa-chevron-left"></i></button>
                <span id="page-num">1</span> / <span id="page-count">0</span>
                <button id="next-page" class="control-btn"><i class="fas fa-chevron-right"></i></button>
                <input type="range" id="zoom-range" min="50" max="200" value="100" step="10">
                <span id="zoom-percent">100%</span>
                <button id="close-fullscreen" class="control-btn" style="display:none;">
                    <i class="fas fa-times"></i> Quitter le plein écran
                </button>
            </div>
            
            <div class="pdf-render">
                <canvas id="pdf-canvas"></canvas>
            </div>
        </div>

        <div class="document-details">
            <h2><i class="fas fa-info-circle"></i> Description</h2>
            <p><?= !empty($document['description']) ? nl2br(htmlspecialchars($document['description'])) : 'Aucune description disponible.' ?></p>
            
            <div class="detail-grid">
                <div class="detail-card">
                    <h3><i class="fas fa-book-open"></i> Matière</h3>
                    <p><?= htmlspecialchars($document['matiere']) ?></p>
                </div>
                <div class="detail-card">
                    <h3><i class="fas fa-graduation-cap"></i> Niveau</h3>
                    <p><?= htmlspecialchars($document['niveau']) ?></p>
                </div>
                <div class="detail-card">
                    <h3><i class="fas fa-file-alt"></i> Type</h3>
                    <p><?= ucfirst($document['type_doc']) ?></p>
                </div>
                <div class="detail-card">
                    <h3><i class="fas fa-database"></i> Taille</h3>
                    <p><?= round(filesize("../docs/" . $document['fichier_url']) / 1024) ?> Ko</p>
                </div>
            </div>
        </div>
    </main>

  <script>
        // Configuration PDF.js corrigée
        pdfjsLib.GlobalWorkerOptions.workerSrc = '../js/pdf/build/pdf.worker.js';
        
        let pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 1.0,
            canvas = document.getElementById('pdf-canvas'),
            ctx = canvas.getContext('2d'),
            isFullscreen = false;

        // Fonction pour charger le PDF
        async function loadPdf() {
            try {
                const url = "../docs/<?= htmlspecialchars($document['fichier_url']) ?>";
                pdfDoc = await pdfjsLib.getDocument({
                    url: url,
                    cMapUrl: '../js/pdf/web/cmaps/',
                    cMapPacked: true
                }).promise;
                
                document.getElementById('page-count').textContent = pdfDoc.numPages;
                await renderPage(1);
            } catch (error) {
                console.error('Erreur PDF:', error);
                alert('Erreur de chargement du document: ' + error.message);
            }
        }

        // Rendu de la page optimisé
        async function renderPage(num) {
            try {
                pageRendering = true;
                const page = await pdfDoc.getPage(num);
                const viewport = page.getViewport({ scale: scale * window.devicePixelRatio });
                
                // Ajustement pour le plein écran
                const container = document.querySelector('.pdf-render');
                if (isFullscreen) {
                    canvas.style.width = '100%';
                    canvas.style.height = '100vh';
                } else {
                    canvas.style.width = 'auto';
                    canvas.style.height = 'auto';
                }
                
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                
                await page.render({
                    canvasContext: ctx,
                    viewport: viewport
                }).promise;
                
                pageRendering = false;
                document.getElementById('page-num').textContent = num;
                
                if (pageNumPending !== null) {
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
            } catch (error) {
                console.error('Erreur rendu:', error);
            }
        }

        // Gestion du plein écran améliorée
        async function toggleFullscreen() {
            const elem = document.querySelector('.pdf-viewer-container');
            
            try {
                if (!document.fullscreenElement) {
                    await elem.requestFullscreen();
                    isFullscreen = true;
                    document.getElementById('fullscreen-btn').innerHTML = '<i class="fas fa-compress"></i> Quitter plein écran';
                    // Réajuster le rendu en plein écran
                    const currentScale = scale;
                    scale = currentScale * 1.5; // Augmenter le zoom en plein écran
                    await renderPage(pageNum);
                } else {
                    await document.exitFullscreen();
                    isFullscreen = false;
                    document.getElementById('fullscreen-btn').innerHTML = '<i class="fas fa-expand"></i> Plein écran';
                    // Rétablir le zoom original
                    scale = scale / 1.5;
                    await renderPage(pageNum);
                }
            } catch (err) {
                alert(`Erreur plein écran: ${err.message}`);
            }
        }

        // Écouteurs d'événements
        document.getElementById('prev-page').addEventListener('click', () => {
            if (pageNum <= 1) return;
            pageNum--;
            queueRenderPage(pageNum);
        });

        document.getElementById('next-page').addEventListener('click', () => {
            if (pageNum >= pdfDoc.numPages) return;
            pageNum++;
            queueRenderPage(pageNum);
        });

        document.getElementById('zoom-range').addEventListener('input', function() {
            scale = this.value / 100;
            document.getElementById('zoom-percent').textContent = this.value + '%';
            queueRenderPage(pageNum);
        });

        document.getElementById('print-btn').addEventListener('click', () => {
            window.print();
        });

        document.getElementById('fullscreen-btn').addEventListener('click', toggleFullscreen);

        // Gestion du redimensionnement
        window.addEventListener('resize', () => {
            if (pageRendering) {
                pageNumPending = pageNum;
            } else {
                renderPage(pageNum);
            }
        });

        // Fonction helper
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', loadPdf);
    </script>
</body>
</html>