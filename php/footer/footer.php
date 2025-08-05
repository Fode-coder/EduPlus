
    <footer class="footer">
        <!-- Effets visuels -->
        <div class="wave-effect"></div>
        <div class="particles" id="particles-js"></div>
        <div class="light-spot"></div>

        <div class="footer-container">
            <!-- Section À propos -->
            <div class="footer-section footer-section-3d about">
                <h3 class="section-title">À propos de nous</h3>
                <div class="about-content">
                    ÉduPlus est une plateforme innovante dédiée à l'éducation et au partage de connaissances pour tous les âges.
                </div>
                <ul class="info-list">
                    <li>Semaine de l'éducation du 15 au 21 octobre</li>
                    <li>Nouveaux cours disponibles cette semaine</li>
                    <li>Concours étudiant - Inscriptions ouvertes</li>
                    <li>Bibliothèque mise à jour avec 50 nouveaux ouvrages</li>
                </ul>
            </div>

            <!-- Section Contact -->
            <div class="footer-section footer-section-3d contact">
                <h3 class="section-title">Contact</h3>
                <ul class="contact-info">
                    <li class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <span>eduplus235@gmail.com</span>
                    </li>
                    <li class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <span>+221 7774535356</span>
                    </li>
                    <li class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <span>Dakar, Sénégal</span>
                    </li>
                </ul>
            </div>

            <!-- Section Réseaux sociaux -->
            <div class="footer-section footer-section-3d social">
                <h3 class="section-title">Suivez-nous</h3>
                <p class="social-intro">Bienvenue sur EduPlus ● La plateforme d'excellence pour apprendre, partager et réussir !</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <!-- Bandeau d'informations -->
        <div class="info-band">
            <div class="info-scroller">
                <div class="info-item">
                    <i class="fas fa-calendar-week info-icon"></i>
                    <span>Semaine de l'éducation du 15 au 21 octobre</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-chalkboard-teacher info-icon"></i>
                    <span>Nouveaux cours disponibles cette semaine</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-trophy info-icon"></i>
                    <span>Concours étudiant - Inscriptions ouvertes</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-book info-icon"></i>
                    <span>Bibliothèque mise à jour avec 50 nouveaux ouvrages</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-graduation-cap info-icon"></i>
                    <span>Formations certifiantes disponibles</span>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="copyright">
            <p class="copyright-text">© 2025 EduPlus. Tous droits réservés.</p>
        </div>
    </footer>
    <link rel="stylesheet" href="../css/footer.css"/>

    <!-- Script pour les particules (optionnel) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Création des particules dynamiques
            const particlesContainer = document.getElementById('particles-js');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                const size = Math.random() * 5 + 2;
                const posX = Math.random() * 100;
                const duration = Math.random() * 20 + 10;
                const delay = Math.random() * 5;
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}%`;
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `${delay}s`;
                
                // Position verticale aléatoire
                particle.style.top = `${Math.random() * 100}%`;
                
                particlesContainer.appendChild(particle);
            }

            // Animation aléatoire du spotlight
            const lightSpot = document.querySelector('.light-spot');
            function moveLightSpot() {
                const x = Math.random() * 80 + 10;
                const y = Math.random() * 80 + 10;
                lightSpot.style.transform = `translate(${x}%, ${y}%)`;
                
                setTimeout(moveLightSpot, 15000);
            }
            moveLightSpot();
        });
    </script>
