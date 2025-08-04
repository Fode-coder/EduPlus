document.addEventListener('DOMContentLoaded', function() {
    // Animations au scroll
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.animate__animated');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.2;
            
            if (elementPosition < screenPosition) {
                const animationType = element.dataset.animation || 'fadeInUp';
                element.classList.add(animationType);
            }
        });
    };

    // Initialisation
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Pour les éléments déjà visibles

    // Accordéon
    const accordionButtons = document.querySelectorAll('.accordion-btn');
    
    accordionButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('active');
            const content = this.nextElementSibling;
            
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    });

    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Initialiser les accordéons ouverts
    const firstAccordion = document.querySelector('.accordion-item:first-child .accordion-btn');
    if (firstAccordion) {
        firstAccordion.classList.add('active');
        firstAccordion.nextElementSibling.style.maxHeight = firstAccordion.nextElementSibling.scrollHeight + 'px';
    }

    // Animation des cartes de mission
    const missionCards = document.querySelectorAll('.mission-card');
    missionCards.forEach((card, index) => {
        card.style.transitionDelay = `${index * 0.1}s`;
    });

    // Effet parallaxe pour la section hero
    const heroSection = document.querySelector('.about-hero');
    if (heroSection) {
        window.addEventListener('scroll', function() {
            const scrollPosition = window.pageYOffset;
            heroSection.style.backgroundPositionY = `${scrollPosition * 0.5}px`;
        });
    }

    // Tooltip pour les réseaux sociaux
    const socialIcons = document.querySelectorAll('.social-overlay a');
    socialIcons.forEach(icon => {
        const platform = icon.querySelector('i').className.split(' ')[1].replace('fa-', '');
        icon.setAttribute('data-tooltip', platform.charAt(0).toUpperCase() + platform.slice(1));
        
        icon.addEventListener('mouseenter', function() {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = this.getAttribute('data-tooltip');
            this.appendChild(tooltip);
            
            setTimeout(() => {
                tooltip.classList.add('show');
            }, 10);
        });
        
        icon.addEventListener('mouseleave', function() {
            const tooltip = this.querySelector('.tooltip');
            if (tooltip) {
                tooltip.classList.remove('show');
                setTimeout(() => {
                    tooltip.remove();
                }, 200);
            }
        });
    });
});

// Intersection Observer pour les animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.timeline-item, .accordion-item').forEach(item => {
    observer.observe(item);
});