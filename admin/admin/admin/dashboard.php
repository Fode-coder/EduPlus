<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/helpers.php';

// Récupérer les stats
$stats = [
    'cours' => $pdo->query("SELECT COUNT(*) FROM documents_college WHERE type_doc = 'cours'")->fetchColumn(),
    'fascicules' => $pdo->query("SELECT COUNT(*) FROM fascicules")->fetchColumn(),
    'membres' => $pdo->query("SELECT COUNT(*) FROM membres_premium")->fetchColumn(),
    'actualites' => $pdo->query("SELECT COUNT(*) FROM actualite")->fetchColumn(),
    'cours_online' => $pdo->query("SELECT COUNT(*) FROM cours_online")->fetchColumn()
];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPlus - Tableau de bord</title>
    <?php include 'partials/header.php'; ?>
</head>

<body class="dashboard">
    <?php include 'partials/sidebar.php'; ?>

    <div class="main-content">
        <?php include 'partials/header.php'; ?>

        <div class="page-content">
            <!-- Cartes Stats -->
            <div class="stats-grid">
                <?php foreach ($stats as $key => $value): ?>
                    <div class="stat-card" data-stat="<?= $key ?>">
                        <div class="stat-icon">
                            <i class="<?= getStatIcon($key) ?>"></i>
                        </div>
                        <h3><?= $value ?></h3>
                        <p><?= ucfirst($key) ?></p>
                        <div class="progress-bar"></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Graphiques -->
            <div class="charts-row">
                <div class="chart-container">
                    <canvas id="activityChart"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="subscriptionChart"></canvas>
                </div>
            </div>

            <!-- Dernières Activités -->
            <div class="recent-activity">
                <h2><i class="fas fa-bell"></i> Activité Récente</h2>
                <div class="activity-list" id="activityFeed">
                    <!-- Chargé en AJAX -->
                </div>
            </div>
        </div>
    </div>

    <?php include 'partials/footer.php'; ?>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>