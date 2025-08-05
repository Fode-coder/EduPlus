document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des particules
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

    // Effet magnetic pour le bouton
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

    // Force du mot de passe
    const passwordInput = document.getElementById('mdp');
    const strengthBar = document.querySelector('.strength-bar');
    const strengthText = document.querySelector('.strength-text');
    
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const strength = checkPasswordStrength(this.value);
            strengthBar.style.width = `${strength.percent}%`;
            strengthBar.style.backgroundColor = strength.color;
            strengthText.textContent = strength.text;
            strengthText.style.color = strength.color;
        });
    }

    function checkPasswordStrength(password) {
        const strength = {
            0: { text: 'Faible', color: '#ff4757', percent: 25 },
            1: { text: 'Moyen', color: '#ffa502', percent: 50 },
            2: { text: 'Fort', color: '#2ed573', percent: 75 },
            3: { text: 'Très fort', color: '#1dd1a1', percent: 100 }
        };
        
        let score = 0;
        
        // Longueur
        if (password.length >= 8) score++;
        if (password.length >= 12) score++;
        
        // Complexité
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;
        
        return strength[Math.min(score, 3)];
    }

    // Validation du formulaire
    const form = document.getElementById('registerForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Vérification des champs
            document.querySelectorAll('[required]').forEach(field => {
                if (!field.value.trim()) {
                    field.parentElement.classList.add('error');
                    isValid = false;
                } else {
                    field.parentElement.classList.remove('error');
                }
            });
            
            // Vérification email
            const email = document.getElementById('email');
            if (email && !/^\S+@\S+\.\S+$/.test(email.value)) {
                email.parentElement.classList.add('error');
                isValid = false;
            }
            
            // Vérification RGPD
            const rgpd = document.getElementById('rgpd');
            if (rgpd && !rgpd.checked) {
                rgpd.parentElement.classList.add('error');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                
                // Animation d'erreur
                const errorFields = document.querySelectorAll('.error');
                errorFields.forEach(field => {
                    field.style.animation = 'shake 0.5s';
                    setTimeout(() => {
                        field.style.animation = '';
                    }, 500);
                });
            }
        });
    }

    // Ajout du style pour l'animation shake
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