<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPlus - Plateforme d'Éducation en Ligne</title>
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="index.css">
    <style>
        .cercle {
  width: 300px;        /* ou n'importe quelle taille */
  height: 300px;
  object-fit: cover;   /* pour que l'image remplisse bien */
  border-radius: 50%;  /* c’est ça qui rend l’image ronde */
  border: 2px solid #fff; /* optionnel : une bordure blanche */
}

    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header déjà inclus -->
    <?php include 'header.php'; ?>
    
    <main>
        <!-- Section 1: Présentation -->
        <section class="presentation-section">
            <div class="container">
                <div class="presentation-content">
                    <div class="text-content animate-on-scroll" data-animation="fade-up">
                        <h1>Bienvenue sur <span>EduPlus</span></h1>
                        <p class="subtitle">La plateforme éducative révolutionnaire pour les élèves du collège au lycée</p>
                        <div class="description">
                            <p>EduPlus offre un environnement d'apprentissage complet avec des cours interactifs, des exercices personnalisés et un suivi pédagogique de qualité.</p>
                            <ul class="features-list">
                                <li>Cours conformes aux programmes officiels</li>
                                <li>Ressources pédagogiques innovantes</li>
                                <li>Suivi individualisé des progrès</li>
                                <li>Accès multi-support 24h/24</li>
                            </ul>
                        </div>
                        <div class="cta-buttons">
                            <a href="#niveaux" class="btn btn-primary">Découvrir les cours</a>
                            <a href="#" class="btn btn-outline">Voir la démo</a>
                        </div>
                    </div>
                    <div class="image-content animate-on-scroll" data-animation="fade-left">
                        <div class="image-wrapper">
                            <img src="../images/eleve.jpg" alt="Étudiants apprenant avec EduPlus" class="cercle">
                            <div class="floating-elements">
                                <div class="circle-element"></div>
                                <div class="square-element"></div>
                                <div class="triangle-element"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="presentation-wave">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
                </svg>
            </div>
        </section>

        <!-- Section 2: Niveaux Scolaires -->
        <section id="niveaux" class="levels-section">
            <div class="container">
                <div class="section-header animate-on-scroll" data-animation="fade-up">
                    <h2>Nos <span>Niveaux</span> Scolaires</h2>
                    <p>Choisissez le programme adapté à votre parcours éducatif</p>
                    <div class="header-decoration">
                        <div class="decoration-line"></div>
                        <div class="decoration-dot"></div>
                        <div class="decoration-line"></div>
                    </div>
                </div>
                
                <div class="levels-grid">
                    <!-- Collège -->
                    <div class="level-category animate-on-scroll" data-animation="fade-up">
                        <h3>Collège</h3>
                        <div class="levels-row">
                            <a href="6eme.php" class="level-card">
                                <div class="card-content">
                                    <span class="grade">6<sup>ème</sup></span>
                                    <p>Cycle 3</p>
                                </div>
                                <div class="hover-effect"></div>
                            </a>
                            <a href="5eme.php" class="level-card">
                                <div class="card-content">
                                    <span class="grade">5<sup>ème</sup></span>
                                    <p>Cycle 4</p>
                                </div>
                                <div class="hover-effect"></div>
                            </a>
                            <a href="4eme.php" class="level-card">
                                <div class="card-content">
                                    <span class="grade">4<sup>ème</sup></span>
                                    <p>Cycle 4</p>
                                </div>
                                <div class="hover-effect"></div>
                            </a>
                            <a href="3eme.php" class="level-card">
                                <div class="card-content">
                                    <span class="grade">3<sup>ème</sup></span>
                                    <p>Cycle 4</p>
                                </div>
                                <div class="hover-effect"></div>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Lycée -->
                    <div class="level-category animate-on-scroll" data-animation="fade-up" style="animation-delay: 0.1s">
                        <h3>Lycée</h3>
                        <div class="levels-row">
                            <a href="2nd.php" class="level-card">
                                <div class="card-content">
                                    <span class="grade">2<sup>nd</sup></span>
                                    <p>Tronc commun</p>
                                </div>
                                <div class="hover-effect"></div>
                            </a>
                            <a href="1ere.php" class="level-card">
                                <div class="card-content">
                                    <span class="grade">1<sup>ère</sup></span>
                                    <p>Spécialités</p>
                                </div>
                                <div class="hover-effect"></div>
                            </a>
                            <a href="terminale.php" class="level-card">
                                <div class="card-content">
                                    <span class="grade">T<sup>le</sup></span>
                                    <p>Baccalauréat</p>
                                </div>
                                <div class="hover-effect"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="levels-pattern">
                <div class="pattern-circle"></div>
                <div class="pattern-square"></div>
            </div>
        </section>

        <!-- Section 3: Statistiques -->
        <section class="stats-section">
            <div class="container">
                <div class="section-header animate-on-scroll" data-animation="fade-up">
                    <h2>EduPlus <span>en Chiffres</span></h2>
                    <p>Une communauté éducative en pleine croissance</p>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card animate-on-scroll" data-animation="fade-up">
                        <div class="stat-content">
                            <div class="stat-value">
                                <span class="counter" data-target="12500">0</span>
                                <span>+</span>
                            </div>
                            <p>Étudiants actifs</p>
                        </div>
                        <div class="stat-wave"></div>
                    </div>
                    
                    <div class="stat-card animate-on-scroll" data-animation="fade-up" style="animation-delay: 0.1s">
                        <div class="stat-content">
                            <div class="stat-value">
                                <span class="counter" data-target="850">0</span>
                            </div>
                            <p>Cours disponibles</p>
                        </div>
                        <div class="stat-wave"></div>
                    </div>
                    
                    <div class="stat-card animate-on-scroll" data-animation="fade-up" style="animation-delay: 0.2s">
                        <div class="stat-content">
                            <div class="stat-value">
                                <span class="counter" data-target="275">0</span>
                            </div>
                            <p>Professeurs experts</p>
                        </div>
                        <div class="stat-wave"></div>
                    </div>
                    
                    <div class="stat-card animate-on-scroll" data-animation="fade-up" style="animation-delay: 0.3s">
                        <div class="stat-content">
                            <div class="stat-value">
                                <span class="counter" data-target="98">0</span>
                                <span>%</span>
                            </div>
                            <p>Taux de satisfaction</p>
                        </div>
                        <div class="stat-wave"></div>
                    </div>
                </div>
            </div>
            <div class="stats-background">
                <div class="bg-element-1"></div>
                <div class="bg-element-2"></div>
            </div>
        </section>

        <!-- Section 4: Témoignages -->
        <section class="testimonials-section">
            <div class="container">
                <div class="section-header animate-on-scroll" data-animation="fade-up">
                    <h2>Ils parlent <span>de nous</span></h2>
                    <p>Découvrez les retours de notre communauté</p>
                </div>
                
                <div class="testimonials-slider swiper animate-on-scroll" data-animation="fade-up">
                    <div class="swiper-wrapper">
                        <!-- Témoignage 1 -->
                        <div class="testimonial-card swiper-slide">
                            <div class="card-content">
                                <div class="quote-icon">"</div>
                                <p class="testimonial-text">Grâce à EduPlus, j'ai pu améliorer mes notes en mathématiques de 3 points en seulement deux mois. Les explications sont très claires et les exercices parfaitement adaptés.</p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">
                                        <img src="../images/im1.jpg" alt="fode K.">
                                    </div>
                                    <div class="author-info">
                                        <h4>fode K.</h4>
                                        <p>Terminale S - Lycée Descartes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-decoration"></div>
                        </div>
                        
                        <!-- Témoignage 2 -->
                        <div class="testimonial-card swiper-slide">
                            <div class="card-content">
                                <div class="quote-icon">"</div>
                                <p class="testimonial-text">La plateforme est intuitive et les cours sont très bien structurés. Parfait pour réviser avant les examens ou combler des lacunes sur des points précis du programme.</p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">
                                        <img src="images/student-2.jpg" alt="Thomas L.">
                                    </div>
                                    <div class="author-info">
                                        <h4>Thomas L.</h4>
                                        <p>1ère ES - Lycée Voltaire</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-decoration"></div>
                        </div>
                        
                        <!-- Témoignage 3 -->
                        <div class="testimonial-card swiper-slide">
                            <div class="card-content">
                                <div class="quote-icon">"</div>
                                <p class="testimonial-text">En tant que parent, je recommande vivement EduPlus. Les progrès de mon fils en physique-chimie sont spectaculaires depuis qu'il utilise la plateforme régulièrement.</p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">
                                        <img src="images/parent-1.jpg" alt="Sophie M.">
                                    </div>
                                    <div class="author-info">
                                        <h4>Sophie M.</h4>
                                        <p>Parent d'élève - 3ème</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-decoration"></div>
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                    
                    <!-- Navigation -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="testimonials-pattern">
                <div class="pattern-dots"></div>
            </div>
        </section>
    </main>

    <!-- Footer déjà inclus -->

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>

  <!-- Footer -->
  
  <?php include 'foot.php'; ?>
  <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="../js/index.js" defer></script>

<script>
  // Initialisation de AOS
  AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true
  });

  // Initialisation de particles.js
  document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('particles-js')) {
      particlesJS('particles-js', {
        /* configurez ici vos particules si nécessaire */
        particles: {
          number: { value: 80, density: { enable: true, value_area: 800 } },
          color: { value: "#ffffff" },
          /* ... autres options ... */
        }
      });
    }

    // Initialisation du slider Swiper
    new Swiper('.testimonial-slider', {
      loop: true,
      autoplay: { delay: 5000 },
      navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
      pagination: { el: '.swiper-pagination', clickable: true }
    });
  });
</script>
</body>
</html>