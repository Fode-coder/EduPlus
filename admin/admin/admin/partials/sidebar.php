<div class="sidebar">
    <div class="logo">
        <i class="fas fa-graduation-cap"></i>
        <span>EduPlus</span>
    </div>

    <nav>
        <ul>
            <li class="active">
                <a href="dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="modules/cours/liste.php">
                    <i class="fas fa-book"></i>
                    <span>Cours</span>
                </a>
            </li>
            <li>
                <a href="modules/fascicules/liste.php">
                    <i class="fas fa-file-alt"></i>
                    <span>fascicules</span>
                </a>
            </li>
            <li>
                <a href="modules/cours_en_ligne/liste.php">
                    <i class="fas fa-video"></i>
                    <span>cours en ligne</span>
                </a>
            </li>
            <li>
                <a href="modules/actualite/liste.php">
                    <i class="fas fa-newspaper"></i>
                    <span>actualites</span>
                </a>
            </li>
            <!-- Autres éléments du menu -->
        </ul>
    </nav>

    <div class="user-panel">
        <img src="../assets/img/avatars/<?= $_SESSION['admin']['id'] ?>.jpg" alt="Avatar">
        <div class="user-info">
            <span><?= $_SESSION['admin']['name'] ?></span>
            <small>Administrateur</small>
        </div>
    </div>
</div>