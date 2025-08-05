document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des particules (identique à inscription.js)
    particlesJS('particles-js', {
        particles: {
            number: { value: 80, density: { enable: true, value_area: 800 } },
            color: { value: "#ffffff" },
            shape: { type: "circle" },
            opacity: { value: 0.3, random: true },
            size: { value: 3, random: true },
            line_linked: { enable: true, distance: 150, color: "#ffffff", opacity: 0.2, width: 1 },
            move: { enable: true, speed: 1, direction: "none", random: true }
        },
        interactivity: {
            detect_on: "canvas",
            events: {
                onhover: { enable: true, mode: "grab" },
                onclick: { enable: true, mode: "push" }
            }
        }
    });

    // Effet magnetic pour le bouton (identique)
    const submitBtn = document.querySelector('.submit-btn');
    
    if (submitBtn) {
        submitBtn.addEventListener('mousemove', (e) => {
            const rect = submitBtn.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            submitBtn.style.setProperty('--x', `${x}px`);
            submitBtn.style.setProperty('--y', `${y}px`);
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const moveX = (x - centerX) * 0.2;
            const moveY = (y - centerY) * 0.2;
            
            submitBtn.style.transform = `translate(${moveX}px, ${moveY}px)`;
        });
        
        submitBtn.addEventListener('mouseleave', () => {
            submitBtn.style.transform = '';
        });
    }

    // Validation du formulaire simplifiée
    const form = document.getElementById('loginForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            document.querySelectorAll('[required]').forEach(field => {
                if (!field.value.trim()) {
                    field.parentElement.classList.add('error');
                    isValid = false;
                } else {
                    field.parentElement.classList.remove('error');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                
                document.querySelectorAll('.error').forEach(field => {
                    field.style.animation = 'shake 0.5s';
                    setTimeout(() => {
                        field.style.animation = '';
                    }, 500);
                });
            }
        });
    }

    // Style dynamique pour les erreurs
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        .error input {
            border-bottom: 2px solid var(--danger) !important;
        }
        
        .error label {
            color: var(--danger) !important;
        }
        
        .error i {
            color: var(--danger) !important;
        }
    `;
    document.head.appendChild(style);
});