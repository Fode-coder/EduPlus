
document.addEventListener('DOMContentLoaded', function() {
    function initFilters() {
    const matiereFilter = document.getElementById('fascicule-matiere-filter');
    const niveauFilter = document.getElementById('fascicule-niveau-filter');
    
    if (matiereFilter && niveauFilter) {
        matiereFilter.addEventListener('change', filterFascicules);
        niveauFilter.addEventListener('change', filterFascicules);
    }
}
initFilters();
function filterFascicules() {
    const matiereValue = document.getElementById('fascicule-matiere-filter').value;
    const niveauValue = document.getElementById('fascicule-niveau-filter').value;

    const fascicules = document.querySelectorAll('.fascicule-card');

    fascicules.forEach(fascicule => {
        const matiere = fascicule.getAttribute('data-matiere');
        const niveau = fascicule.getAttribute('data-niveau');

        const matiereMatch = matiereValue === 'all' || matiere === matiereValue;
        const niveauMatch = niveauValue === 'all' || niveau === niveauValue;

        fascicule.style.display = (matiereMatch && niveauMatch) ? 'block' : 'none';
    });
}

    
    // Loading Screen
    console.log("Salut Mod !");
// Vérifiez que ce code est bien exécuté dans com.js
setTimeout(() => {
    document.querySelector('.loading-screen').style.opacity = '0';
    setTimeout(() => {
        document.querySelector('.loading-screen').style.display = 'none';
    }, 500); // 0.5s pour l'animation de fondu
}, 1500); // 1.5s de chargement simulé
     // filtre
       // Initialisation des filtres
    function initFilters() {
        // Filtres pour les fascicules
        const matiereFilter = document.querySelector('#fascicules .styled-select:nth-of-type(1)');
        const niveauFilter = document.querySelector('#fascicules .styled-select:nth-of-type(2)');
        
        if (matiereFilter && niveauFilter) {
            matiereFilter.addEventListener('change', filterFascicules);
            niveauFilter.addEventListener('change', filterFascicules);
        }
    }



    //js pour question 

    const navLinks = document.querySelectorAll('.sidebar-nav a, #questions-link');
    const sections = document.querySelectorAll('.content-section');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Retirer la classe active de tous les liens
            navLinks.forEach(navLink => {
                navLink.parentElement.classList.remove('active');
            });
            
            // Ajouter la classe active au lien cliqué
            this.parentElement.classList.add('active');
            
            // Masquer toutes les sections
            sections.forEach(section => {
                section.style.display = 'none';
            });
            
            // Afficher la section cible
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                targetSection.style.display = 'block';
                targetSection.classList.add('animate__animated', 'animate__fadeIn');
                
                // Faire défiler vers le haut de la section
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Activer la section questions si l'URL contient un hash
    if (window.location.hash === '#questions') {
        document.querySelector('#questions-link').click();
    }
    //mmmmmmmmmmmm
    // Gestion du bouton "Poser une question"
const askQuestionBtn = document.getElementById('ask-question-btn');
const questionFormContainer = document.querySelector('.question-form-container');

if (askQuestionBtn && questionFormContainer) {
    askQuestionBtn.addEventListener('click', function() {
        questionFormContainer.style.display = questionFormContainer.style.display === 'none' ? 'block' : 'none';
        
        // Faire défiler jusqu'au formulaire si on l'affiche
        if (questionFormContainer.style.display === 'block') {
            questionFormContainer.scrollIntoView({ behavior: 'smooth' });
        }
    });
    
    // Annulation du formulaire
    const cancelQuestionBtn = document.getElementById('cancel-question-btn');
    if (cancelQuestionBtn) {
        cancelQuestionBtn.addEventListener('click', function() {
            questionFormContainer.style.display = 'none';
        });
    }
}
    // Dark Mode Toggle
    const darkModeBtn = document.querySelector('.btn-dark-mode');
    darkModeBtn.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        
        // Save preference to localStorage
        const isDarkMode = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDarkMode);
        
        // Update icon
        const icon = darkModeBtn.querySelector('i');
        icon.className = isDarkMode ? 'fas fa-sun' : 'fas fa-moon';
    });

    // Check for saved dark mode preference
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
        const icon = darkModeBtn.querySelector('i');
        icon.className = 'fas fa-sun';
    }
    setupMobileNavigation();
    
    // Gestion spécifique mobile
    if (window.matchMedia("(max-width: 768px)").matches) {
        // Activer le dashboard par défaut
        document.getElementById('dashboard').style.display = 'block';
        document.querySelector('.sidebar-nav li.active').classList.remove('active');
        document.querySelector('.sidebar-nav li:first-child').classList.add('active');
    }

    // Navigation between sections
    // Navigation entre sections
document.querySelectorAll('.sidebar-nav a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Masquer toutes les sections
        document.querySelectorAll('.content-section').forEach(section => {
            section.style.display = 'none';
        });
        
        // Afficher la section cible
        const targetId = this.getAttribute('href');
        const targetSection = document.querySelector(targetId);
        if (targetSection) {
            targetSection.style.display = 'block';
            targetSection.classList.add('animate__animated', 'animate__fadeIn');
        }
    });
});
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links
            navLinks.forEach(navLink => {
                navLink.parentElement.classList.remove('active');
            });
            
            // Add active class to clicked link
            this.parentElement.classList.add('active');
            
            // Hide all sections
            sections.forEach(section => {
                section.style.display = 'none';
            });
            
            // Show target section
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                targetSection.style.display = 'block';
                targetSection.classList.add('animate__animated', 'animate__fadeIn');
            }
        });
    });

    // Initialize tooltips
    tippy('[data-tippy-content]', {
        theme: 'light-border',
        animation: 'scale',
        duration: 200,
        arrow: true
    });

    // Animate elements on scroll
    gsap.utils.toArray('.animate-on-scroll').forEach(element => {
        gsap.from(element, {
            opacity: 0,
            y: 50,
            duration: 0.8,
            scrollTrigger: {
                trigger: element,
                start: "top 80%",
                toggleActions: "play none none none"
            }
        });
    });

    // Notification dropdown
    const notificationBtn = document.querySelector('.btn-notification');
    notificationBtn.addEventListener('click', () => {
        // Toggle notification dropdown
        console.log('Show notifications');
    });

    // Logout button
    const logoutBtn = document.querySelector('.btn-logout');
    logoutBtn.addEventListener('click', () => {
        // Implement logout logic
        window.location.href = 'logout.php';
    });

    // Search functionality
    const searchInput = document.querySelector('.search-bar input');
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            // Implement search
            console.log('Search for:', this.value);
        }
    });

    // Responsive menu toggle (for mobile)
    const menuToggle = document.createElement('div');
    menuToggle.className = 'mobile-menu-btn';
    menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
    document.querySelector('.top-bar').prepend(menuToggle);
    
    menuToggle.addEventListener('click', () => {
        document.body.classList.toggle('sidebar-open');
    });
});

// Additional GSAP animations
function initAnimations() {
    // Animate sidebar elements
    gsap.from('.premium-sidebar > *', {
        opacity: 0,
        y: 20,
        duration: 0.6,
        stagger: 0.1,
        delay: 1.5
    });
    
    // Animate main content
    gsap.from('.content-section', {
        opacity: 0,
        y: 30,
        duration: 0.8,
        delay: 1.8
    });
}
// Dans votre fichier com.js

// Gestion du dashboard mobile
function initMobileDashboard() {
    const isMobile = window.matchMedia("(max-width: 768px)").matches;
    
    if (isMobile) {
        // Afficher le dashboard par défaut sur mobile
        document.getElementById('dashboard').style.display = 'block';
        
        // Créer le bouton menu mobile si inexistant
        if (!document.querySelector('.mobile-menu-btn')) {
            const menuBtn = document.createElement('button');
            menuBtn.className = 'mobile-menu-btn';
            menuBtn.innerHTML = '<i class="fas fa-bars"></i>';
            
            const topBar = document.querySelector('.top-bar');
            topBar.insertBefore(menuBtn, topBar.firstChild);
            
            // Gestion du clic
            menuBtn.addEventListener('click', function() {
                document.body.classList.toggle('sidebar-open');
            });
        }
    }
}

// Appeler cette fonction au chargement et au redimensionnement
window.addEventListener('load', initMobileDashboard);
window.addEventListener('resize', initMobileDashboard);
// Navigation améliorée pour mobile
function setupMobileNavigation() {
    const navLinks = document.querySelectorAll('.sidebar-nav a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Fermer le menu mobile
            document.body.classList.remove('sidebar-open');
            
            // Désactiver tous les liens
            navLinks.forEach(lnk => {
                lnk.parentElement.classList.remove('active');
            });
            
            // Activer le lien cliqué
            this.parentElement.classList.add('active');
            
            // Masquer toutes les sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.style.display = 'none';
            });
            
            // Afficher la section cible
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                targetSection.style.display = 'block';
                targetSection.classList.add('animate__animated', 'animate__fadeIn');
                
                // Scroll doux vers la section sur mobile
                setTimeout(() => {
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 300);
            }
        });
    });
}


// Initialisation au chargement

window.addEventListener('load', initAnimations);