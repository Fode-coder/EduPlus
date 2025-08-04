<?php
session_start();
require_once '../php/config.php';

// Vérification connexion + récupération données
if (!isset($_SESSION['user'])) {
    header('Location: login.php?redirect=communaute');
    exit();
}


    $user_id = $_SESSION['user']['id'];
    
    // Récupération des données membres
    $stmt = $pdo->prepare("SELECT * FROM membres_premium WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    
    if (!$user) {
        session_destroy();
        header('Location: login.php');
        exit();
    }

    // Récupération des fascicules

    $fascicules = $pdo->query("SELECT * FROM fascicules WHERE statut = 'actif'")->fetchAll();
    // Récupération des cours en ligne
    $cours = $pdo->query("SELECT c.*, m.nom AS matiere_nom, 
                          (SELECT COUNT(*) FROM modules_cours WHERE cours_id = c.id) AS nb_modules,
                          (SELECT COUNT(*) FROM progression_cours WHERE cours_id = c.id AND membre_id = $user_id AND progression = 100) AS modules_completes
                          FROM cours_online c JOIN matieres m ON c.matiere_id = m.id 
                          WHERE c.statut = 'publie'")->fetchAll();
    
// Récupération des questions récentes
$matieres = $pdo->query("SELECT DISTINCT matiere FROM fascicules")->fetchAll(PDO::FETCH_COLUMN);
$niveaux = $pdo->query("SELECT DISTINCT niveau FROM fascicules")->fetchAll(PDO::FETCH_COLUMN);


    $stats = $pdo->query("SELECT 
                          (SELECT COUNT(*) FROM consultations_fascicules WHERE membre_id = $user_id) AS fascicules_consultes,
                          (SELECT COUNT(*) FROM telechargements WHERE membre_id = $user_id) AS fascicules_telecharges,
                          (SELECT COUNT(*) FROM progression_cours WHERE membre_id = $user_id AND progression = 100) AS cours_completes,
                          (SELECT COUNT(*) FROM questions WHERE auteur_id = $user_id) AS questions_posees")->fetch();



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Membre Premium | EduPlus</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../css/com.css">
    <link rel="stylesheet" href="../css/fasc.css">
    <link rel="stylesheet" href="../css/discord.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy.min.css">
    
</head>
<body class="dark-mode">
    <!-- Loading Screen -->
    <div class="loading-screen">
        <div class="loader">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
    </div>

    <!-- Sidebar Premium -->
    <aside class="premium-sidebar">
        <div class="sidebar-header">
            <img src="../assets/logo-eduplus-white.svg" alt="EduPlus" class="logo">
            <div class="user-profile">
                <div class="avatar-container">
                    <img src="<?= htmlspecialchars($user['avatar'] ?? '../assets/default-avatar.jpg') ?>" alt="Avatar" class="avatar">
                    <span class="online-status"></span>
                </div>
                <div class="user-info">
                    <h3><?= htmlspecialchars($user['prenom']) ?></h3>
                    <p class="badge-member">Membre <?= ucfirst($user['statut'])?></p>
                </div>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <ul>
                <li class="active">
                    <a href="#dashboard">
                        <i class="fas fa-home"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="#fascicules">
                        <i class="fas fa-book-open"></i>
                        <span>Fascicules</span>
                    </a>
                </li>
                <li>
                    <a href="#cours">
                        <i class="fas fa-play-circle"></i>
                        <span>Cours en ligne</span>
                    </a>
                </li>
                
                <li>
                    <a href="#questions">
                        <i class="fas fa-comments"></i>
                        <span>Espace d'echanges</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <button class="btn-dark-mode">
                <i class="fas fa-moon"></i>
                <span>Mode sombre</span>
            </button>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <header class="top-bar">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Rechercher..." id="global-search">
            </div>
            <div class="user-actions">
                <button class="btn-notification" id="notifications-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <button class="btn-logout" id="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
            
            <!-- Dropdown Notifications -->
            <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h4>Notifications</h4>
                    <button class="mark-all-read">Tout marquer comme lu</button>
                </div>
                <div class="notifications-list">
                    <div class="notification-item unread">
                        <div class="notification-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="notification-content">
                            <p>Nouveau fascicule disponible: Algèbre avancée</p>
                            <span class="notification-time">Il y a 2 heures</span>
                        </div>
                    </div>
                    <!-- Plus de notifications -->
                </div>
                <div class="notifications-footer">
                    <a href="#">Voir toutes les notifications</a>
                </div>
            </div>
        </header>
        
        <!-- Dashboard Section -->
        <section id="dashboard" class="content-section animate__animated animate__fadeIn">
            <div class="section-header">
                <h2><i class="fas fa-home"></i> Tableau de bord</h2>
                <p>Bienvenue dans votre espace membre premium</p>
            </div>
            
            <div class="stats-grid">
                <!-- Stat Card 1 -->
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?= $stats['fascicules_consultes'] ?></h3>
                        <p>Fascicules consultés</p>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar" style="width: <?= min(100, ($stats['fascicules_consultes']/30)*100) ?>%"></div>
                    </div>
                </div>
                
                <!-- Stat Card 2 -->
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?= $stats['fascicules_telecharges'] ?></h3>
                        <p>Fascicules téléchargés</p>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar" style="width: <?= min(100, ($stats['fascicules_telecharges']/20)*100) ?>%"></div>
                    </div>
                </div>
                
                <!-- Stat Card 3 -->
                
                
                <!-- Stat Card 4 -->
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?= $stats['questions_posees'] ?></h3>
                        <p>Questions posées</p>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar" style="width: <?= min(100, ($stats['questions_posees']/15)*100) ?>%"></div>
                    </div>
                </div>
            </div>
            
          
            
            <!-- Recent Activity -->
            <div class="recent-activity">
                <h3>Activité récente</h3>
                <div class="activity-timeline">
                    <!-- Exemple d'activité -->
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="activity-content">
                            <p>Vous avez consulté le fascicule "Algèbre linéaire"</p>
                            <span class="activity-time">Il y a 2 heures</span>
                        </div>
                    </div>
                    <!-- Plus d'activités -->
                </div>
            </div>
        </section>
        
        <!-- Fascicules Section -->
        <!-- Fascicules Section -->
        <section id="fascicules" class="content-section animate__animated animate__fadeIn" style="display:none;">
            <div class="section-header">
                <h2><i class="fas fa-book-open"></i> Fascicules Premium</h2>
                <p>Accédez à nos ressources exclusives</p>
            </div>
            
            <div class="filters-bar">
                <div class="filter-group">
                    <label>Matière :</label>
                    <select class="styled-select" id="fascicule-matiere-filter">
                        <option value="all">Toutes</option>
                        <?php foreach ($matieres as $matiere): ?>
                        <option value="<?= htmlspecialchars($matiere) ?>"><?= htmlspecialchars($matiere) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Niveau :</label>
                    <select class="styled-select" id="fascicule-niveau-filter">
                        <option value="all">Tous</option>
                        <?php foreach ($niveaux as $niveau): ?>
                        <option value="<?= htmlspecialchars($niveau) ?>"><?= htmlspecialchars($niveau) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="fascicules-grid">
                <?php foreach ($fascicules as $fascicule): ?>
                <div class="fascicule-card" data-matiere="<?= htmlspecialchars($fascicule['matiere']) ?>" data-niveau="<?= htmlspecialchars($fascicule['niveau']) ?>">
                    <div class="fascicule-thumbnail" 
                         style="background-image: url('<?= htmlspecialchars($fascicule['image_url']) ?>')">
                        <div class="fascicule-badge"><?= htmlspecialchars($fascicule['niveau']) ?></div>
                    </div>
                    <div class="fascicule-details">
                        <div class="fascicule-header">
                            <h3><?= htmlspecialchars($fascicule['titre']) ?></h3>
                            <div class="fascicule-meta">
                                <span><i class="fas fa-file-pdf"></i> PDF</span>
                                <span><i class="fas fa-clock"></i> <?= $fascicule['duree'] ?> min</span>
                                <span><i class="fas fa-graduation-cap"></i> <?= htmlspecialchars($fascicule['matiere']) ?></span>
                            </div>
                        </div>
                        <p class="fascicule-description"><?= htmlspecialchars($fascicule['description']) ?></p>
                        <div class="fascicule-footer">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <span>4.8</span>
                            </div>
                            <div class="fascicule-actions">
                                <a href="view_fascicule.php?id=<?= $fascicule['id'] ?>" class="view-btn">
                                    <i class="fas fa-eye"></i> Consulter
                                </a>
                                <a href="download.php?id=<?= $fascicule['id'] ?>" class="download-btn">
                                    <i class="fas fa-download"></i> Télécharger
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        
        <!-- Cours en Ligne Section -->
        <section id="cours" class="content-section animate__animated animate__fadeIn" style="display:none;">
            <div class="section-header">
                <h2><i class="fas fa-play-circle"></i> Cours en Ligne</h2>
                <p>Accédez à nos formations premium</p>
            </div>
            
            <div class="filters-bar">
                <div class="filter-group">
                    <label>Matière :</label>
                    <select class="styled-select" id="cours-matiere-filter">
                        <option value="0">Toutes</option>
                        <?php 
                        $matieres = $pdo->query("SELECT * FROM matieres")->fetchAll();
                        foreach ($matieres as $matiere): ?>
                        <option value="<?= $matiere['id'] ?>"><?= htmlspecialchars($matiere['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Niveau :</label>
                    <select class="styled-select" id="cours-niveau-filter">
                        <option value="all">Tous</option>
                        <option value="debutant">Débutant</option>
                        <option value="intermediaire">Intermédiaire</option>
                        <option value="avance">Avancé</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Progression :</label>
                    <select class="styled-select" id="cours-progress-filter">
                        <option value="all">Tous</option>
                        <option value="not-started">Pas commencé</option>
                        <option value="in-progress">En cours</option>
                        <option value="completed">Complété</option>
                    </select>
                </div>
            </div>
            
            <div class="cours-grid">
                <?php foreach ($cours as $cour): 
                $progress = $cour['nb_modules'] > 0 ? round(($cour['modules_completes']/$cour['nb_modules'])*100) : 0;
                ?>
                <div class="cours-card" data-matiere="<?= $cour['matiere_id'] ?>" data-niveau="<?= $cour['niveau'] ?>" data-progress="<?= $progress ?>">
                    <div class="cours-thumbnail" style="background-image: url('<?= htmlspecialchars($cour['image_url']) ?>')">
                        <div class="cours-badge"><?= ucfirst($cour['niveau']) ?></div>
                        <div class="cours-progress">
                            <div class="progress-bar" style="width: <?= $progress ?>%"></div>
                            <span><?= $progress ?>% complété</span>
                        </div>
                    </div>
                    <div class="cours-details">
                        <div class="cours-header">
                            <h3><?= htmlspecialchars($cour['titre']) ?></h3>
                            <div class="cours-meta">
                                <span><i class="fas fa-clock"></i> <?= floor($cour['duree_totale']/60) ?>h<?= $cour['duree_totale']%60 ?></span>
                                <span><i class="fas fa-book"></i> <?= $cour['nb_modules'] ?> modules</span>
                                <span><i class="fas fa-graduation-cap"></i> <?= htmlspecialchars($cour['matiere_nom']) ?></span>
                            </div>
                        </div>
                        <p class="cours-description"><?= htmlspecialchars($cour['description']) ?></p>
                        <div class="cours-footer">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <span>4.7</span>
                            </div>
                            <a href="cours_detail.php?id=<?= $cour['id'] ?>" class="start-btn">
                                <?= $progress > 0 ? 'Continuer' : 'Commencer' ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
         <!-- discord section -->
        <section id="questions" class="content-section animate__animated animate__fadeIn" style="display:none;">
           
<div class="discord-sidebar-section">
<div class="sidebar-divider"></div>
    <div class="discord-widget">
        <h4><i class="fab fa-discord"></i> Communauté</h4>
        <iframe src="https://discord.com/widget?id=VOTRE_ID&theme=dark" 
                width="100%" 
                height="250"
                style="border:none;border-radius:8px;margin-top:10px;"
                allowtransparency="true">
        </iframe>
        <a href="https://discord.gg/fEhJDuwwuj" class="discord-link">
            Rejoindre le serveur <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>
        </section>
    </main>

    
    <div class="modal-overlay" id="modal-overlay" style="display:none;">
        <div class="modal-container">
            <div class="modal-header">
                <h3 id="modal-title">Titre du modal</h3>
                <button class="modal-close" id="modal-close">&times;</button>
            </div>
            <div class="modal-content" id="modal-content">
                Contenu du modal...
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" id="modal-cancel">Annuler</button>
                <button class="btn-confirm" id="modal-confirm">Confirmer</button>
            </div>
        </div>
    </div>
                        -->
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy.min.js"></script>
    <script src="com.js"></script>
    <script src="save_question.js"></script>


</body>
</html>