<?php
require_once '../../../includes/auth.php';
require_once '../../../includes/db.php';
require_once '../../../includes/helpers.php';

$cours = $pdo->query("SELECT * FROM documents_college WHERE type_doc = 'cours' ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gestion des Cours | EduPlus</title>
    <?php include '../../partials/header.php'; ?>
    <link rel="stylesheet" href="cours.css">
</head>

<body class="dashboard">
    <div class="main-content">
        <div class="header">
            <div class="header-left">
                <a href="../../dashboard.php" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Retour au dashboard
                </a>
            </div>
            <div class="header-right">
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#coursModal">
                    <i class="fas fa-plus-circle"></i> Nouveau cours
                </button>
            </div>
        </div>

        <div class="content-container">
            <div class="page-title">
                <h1><i class="fas fa-book-open"></i> Gestion des Cours</h1>
                <p>Liste complète des ressources pédagogiques</p>
            </div>

            <div class="cours-list-container">
                <?php if (empty($cours)): ?>
                    <div class="empty-state">
                        <i class="fas fa-book"></i>
                        <h3>Aucun cours disponible</h3>
                        <p>Commencez par ajouter votre premier cours</p>
                    </div>
                <?php else: ?>
                    <div class="cours-list">
                        <?php foreach ($cours as $c): ?>
                        <div class="cours-card" data-id="<?= $c['id'] ?>">
                            <div class="cours-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="cours-info">
                                <h3><?= htmlspecialchars($c['titre']) ?></h3>
                                <div class="meta">
                                    <span class="matiere"><?= htmlspecialchars($c['matiere']) ?></span>
                                    <span class="classe"><?= htmlspecialchars($c['niveau']) ?></span>
                                </div>
                                <p class="description"><?=htmlspecialchars($c['description'] ) ?></p>
                            </div>
                            <div class="cours-actions">
                                <button class="btn-action edit-btn" data-id="<?= $c['id'] ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-action delete-btn" data-id="<?= $c['id'] ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <a href="<?= getFilePath($c['fichier']) ?>" class="btn-action download-btn" target="_blank">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal Ajout/Modification -->
    <div class="modal fade" id="coursModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"><i class="fas fa-book"></i> Ajouter un cours</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="coursForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="coursId">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="titre" class="form-label">Titre du cours*</label>
                                <input type="text" class="form-control" id="titre" name="titre" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="matiere" class="form-label">Matière*</label>
                                <input type="text" class="form-control" id="matiere" name="matiere" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="niveau" class="form-label">Classe*</label>
                                <input type="text" class="form-control" id="niveau" name="niveau" required>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            
                            <div class="form-group file-upload">
                                <label for="fichier" class="form-label">Fichier PDF*</label>
                                <div class="upload-area" id="uploadArea">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Glissez-déposez votre fichier ou <span>parcourir</span></p>
                                    <input type="file" id="fichier" name="fichier" accept=".pdf" required>
                                </div>
                                <div class="file-preview" id="filePreview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../../partials/footer.php'; ?>
    <script src="cours.js"></script>
</body>
</html>