
    <header class="header">
        <!-- Effets visuels -->
        <div class="particles" id="header-particles"></div>
        <div class="light-spot"></div>

        <div class="header-container">
            <!-- Logo + Nom (à gauche) -->
            <div class="logo-group">
                <a href="apropos.html" class="logo-link">
                    <img src="../images/logo.jpg" alt="ÉduPlus" class="logo-img">
                    <span class="logo-text">Édu<span class="highlight">Plus</span></span>
                </a>
            </div>

            <!-- Navigation centrale -->
            <nav class="main-nav">
                <ul class="nav-list">
                    <li class="nav-item active">
                        <a href="index.php" class="nav-link">
                            <i class="fas fa-home icon"></i>
                            <span>Accueil</span>
                            <div class="underline"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="apropos.html" class="nav-link">
                            <i class="fas fa-info-circle icon"></i>
                            <span>À propos</span>
                            <div class="underline"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.html" class="nav-link">
                            <i class="fas fa-envelope icon"></i>
                            <span>Contact</span>
                            <div class="underline"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../php/login.php" class="nav-link">
                            <i class="fas fa-users icon"></i>
                            <span>communauté</span>
                            <div class="underline"></div>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Groupe droit (recherche + connexion) -->
            <div class="action-group">
                <!-- Recherche -->
                <div class="search-wrapper">
                    <input type="text" placeholder="Rechercher..." class="search-input">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <!--
                <div class="auth-wrapper">
                    <a href="/login" class="auth-btn">
                        <i class="fas fa-user"></i>
                        <span>Connexion</span>
                    </a>
                </div>


                <a href="../php/inscription.php" class="cta-btn">
                    <span>S'inscrire</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                -->
            </div>

            <!-- Menu mobile -->
            <button class="menu-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
        <link rel="stylesheet" href="../css/header.css"/>
    </header>
