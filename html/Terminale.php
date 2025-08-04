<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix de la série - Terminale | EduPlus</title>
    <link rel="stylesheet" href="../css/series.css">
    <link rel="stylesheet" href="../css/footer.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- En-tête -->
    <?php include 'header.php'; ?>

    <main>
        <!-- Section Hero -->
        <section class="hero-section">
            <div class="hero-content">
                <h1>Orientation en <span>Terminale</span></h1>
                <p class="subtitle">Choisissez la série qui correspond à votre projet d'études</p>
                <div class="decoration-line"></div>
            </div>
            <div class="hero-illustration">
                <img src="../images/second-illustration.svg" alt="Élève en seconde" loading="lazy">
            </div>
        </section>

        <!-- Choix des séries -->
        <section class="series-section">
            <div class="section-header">
                <h2>Nos <span>séries</span></h2>
                <p>Sélectionnez votre parcours pour accéder aux cours adaptés</p>
            </div>

            <div class="series-grid">
                <!-- Série Scientifique -->
                <a href="terminale_s.php" class="serie-card serie-scientifique">
                    <div class="serie-icon">
                        <i class="fas fa-atom"></i>
                    </div>
                    <h3>Série Scientifique</h3>
                    <p>Mathématiques, Physique, SVT</p>
                    <div class="serie-hover"></div>
                </a>

                <!-- Série Littéraire -->
                <a href="terminale_l.php" class="serie-card serie-litteraire">
                    <div class="serie-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3>Série Littéraire</h3>
                    <p>Littérature, Langues, Philosophie</p>
                    <div class="serie-hover"></div>
                </a>

                <!-- Série Gestion -->
                <a href="terminale_g.php" class="serie-card serie-gestion">
                    <div class="serie-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3>Série Gestion</h3>
                    <p>Économie, Comptabilité, Management</p>
                    <div class="serie-hover"></div>
                </a>
            </div>
        </section>
    </main>

    <!-- Pied de page -->
    <?php include 'foot.php'; ?>

</body>
</html>