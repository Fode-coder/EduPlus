document.addEventListener('DOMContentLoaded', function() {
    // Création des particules dynamiques
    const particlesContainer = document.getElementById('header-particles');
    const particleCount = 20;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        
        const size = Math.random() * 4 + 1;
        const posX = Math.random() * 100;
        const duration = Math.random() * 15 + 10;
        const delay = Math.random() * 5;
        
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${posX}%`;
        particle.style.top = `${Math.random() * 100}%`;
        particle.style.animationDuration = `${duration}s`;
        particle.style.animationDelay = `${delay}s`;
        
        particlesContainer.appendChild(particle);
    }

    // Menu mobile
    const hamburgerBtn = document.querySelector('.hamburger-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    const body = document.body;

    hamburgerBtn.addEventListener('click', function() {
        body.classList.toggle('menu-active');
    });

    // Effet magnet sur les boutons
    const magnetButtons = document.querySelectorAll('.magnet-btn');
    
    magnetButtons.forEach(button => {
        button.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const moveX = (x - centerX) / 5;
            const moveY = (y - centerY) / 5;
            
            this.style.transform = `translate(${moveX}px, ${moveY}px)`;
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translate(0, 0)';
        });
    });

    // Animation du spotlight
    const lightSpot = document.querySelector('.light-spot');
    function moveLightSpot() {
        const x = Math.random() * 80 + 10;
        const y = Math.random() * 80 + 10;
        lightSpot.style.transform = `translate(${x}%, ${y}%)`;
        
        setTimeout(moveLightSpot, 15000);
    }
    moveLightSpot();

    // Fermer le menu mobile en cliquant sur un lien
    const mobileLinks = document.querySelectorAll('.mobile-nav-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            body.classList.remove('menu-active');
        });
    });

    // Gestion du scroll pour l'ombre du header
    window.addEventListener('scroll', function() {
        if (window.scrollY > 10) {
            document.querySelector('.header').style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.2)';
        } else {
            document.querySelector('.header').style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.1)';
        }
    });
});