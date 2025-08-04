document.addEventListener('DOMContentLoaded', function() {
    // Preloader
    window.addEventListener('load', function() {
        const preloader = document.querySelector('.preloader');
        setTimeout(() => {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        }, 1000);
    });

    // Particles.js Background
    particlesJS('particles-js', {
        "particles": {
            "number": {
                "value": 80,
                "density": {
                    "enable": true,
                    "value_area": 800
                }
            },
            "color": {
                "value": "#ffffff"
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                }
            },
            "opacity": {
                "value": 0.3,
                "random": true,
                "anim": {
                    "enable": true,
                    "speed": 1,
                    "opacity_min": 0.1,
                    "sync": false
                }
            },
            "size": {
                "value": 3,
                "random": true,
                "anim": {
                    "enable": true,
                    "speed": 2,
                    "size_min": 0.1,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 150,
                "color": "#ffffff",
                "opacity": 0.2,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 1,
                "direction": "none",
                "random": true,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": true,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": true,
                    "mode": "grab"
                },
                "onclick": {
                    "enable": true,
                    "mode": "push"
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 140,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "push": {
                    "particles_nb": 4
                }
            }
        },
        "retina_detect": true
    });

    // Tab System
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked button and corresponding content
            button.classList.add('active');
            document.getElementById(`${tabId}-tab`).classList.add('active');
        });
    });

    // Accordion System
    const accordionItems = document.querySelectorAll('.accordion-item');

    accordionItems.forEach(item => {
        const header = item.querySelector('.accordion-header');
        
        header.addEventListener('click', () => {
            const currentlyActive = document.querySelector('.accordion-item.active');
            
            // Close currently active item if it's not the clicked one
            if (currentlyActive && currentlyActive !== item) {
                currentlyActive.classList.remove('active');
            }
            
            // Toggle clicked item
            item.classList.toggle('active');
        });
    });

    // Magnetic Button Effect
    const magneticButtons = document.querySelectorAll('.magnetic');

    magneticButtons.forEach(button => {
        button.addEventListener('mousemove', (e) => {
            const rect = button.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            button.style.setProperty('--x', `${x}px`);
            button.style.setProperty('--y', `${y}px`);
            
            // Add slight movement effect
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const moveX = (x - centerX) * 0.2;
            const moveY = (y - centerY) * 0.2;
            
            button.style.transform = `translate(${moveX}px, ${moveY}px)`;
        });
        
        button.addEventListener('mouseleave', () => {
            button.style.transform = '';
        });
    });

    // Form Validation
    const contactForm = document.getElementById('premiumContactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form elements
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const subject = document.getElementById('subject');
            const message = document.getElementById('message');
            const submitBtn = this.querySelector('button[type="submit"]');
            
            // Simple validation
            let isValid = true;
            
            if (!name.value.trim()) {
                isValid = false;
                name.parentElement.classList.add('error');
            } else {
                name.parentElement.classList.remove('error');
            }
            
            if (!email.value.trim() || !/^\S+@\S+\.\S+$/.test(email.value)) {
                isValid = false;
                email.parentElement.classList.add('error');
            } else {
                email.parentElement.classList.remove('error');
            }
            
            if (!subject.value) {
                isValid = false;
                subject.parentElement.classList.add('error');
            } else {
                subject.parentElement.classList.remove('error');
            }
            
            if (!message.value.trim()) {
                isValid = false;
                message.parentElement.classList.add('error');
            } else {
                message.parentElement.classList.remove('error');
            }
            
            if (isValid) {
                // Simulate form submission
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi en cours...';
                submitBtn.disabled = true;
                
                setTimeout(() => {
                    submitBtn.innerHTML = '<i class="fas fa-check"></i> Envoyé !';
                    
                    // Show success message
                    const successMessage = document.createElement('div');
                    successMessage.className = 'success-message';
                    successMessage.innerHTML = `
                        <i class="fas fa-check-circle"></i>
                        <p>Merci ! Votre message a été envoyé avec succès.</p>
                    `;
                    contactForm.appendChild(successMessage);
                    
                    // Reset form after delay
                    setTimeout(() => {
                        contactForm.reset();
                        successMessage.remove();
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 3000);
                }, 1500);
            }
        });
    }

    // Tooltip for social icons
    const socialIcons = document.querySelectorAll('.social-icon');
    
    socialIcons.forEach(icon => {
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

    // Floating contact bubble
    const contactBubble = document.querySelector('.contact-bubble');
    
    if (contactBubble) {
        contactBubble.addEventListener('click', function() {
            // Scroll to form
            document.querySelector('.glass-panel').scrollIntoView({
                behavior: 'smooth'
            });
            
            // Activate form tab
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            document.querySelector('.tab-btn[data-tab="form"]').classList.add('active');
            document.getElementById('form-tab').classList.add('active');
        });
    }
});

// Add tooltip styles dynamically
const style = document.createElement('style');
style.textContent = `
    .tooltip {
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0,0,0,0.8);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.8rem;
        white-space: nowrap;
        margin-bottom: 10px;
        opacity: 0;
        transition: opacity 0.2s ease;
        pointer-events: none;
    }
    
    .tooltip::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border-width: 5px 5px 0;
        border-style: solid;
        border-color: rgba(0,0,0,0.8) transparent transparent;
    }
    
    .tooltip.show {
        opacity: 1;
    }
    
    .success-message {
        background: rgba(0,206,201,0.2);
        border: 1px solid var(--secondary);
        border-radius: 10px;
        padding: 15px;
        margin-top: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: fadeIn 0.5s ease;
    }
    
    .success-message i {
        color: var(--secondary);
        font-size: 1.5rem;
    }
    
    .success-message p {
        margin: 0;
    }
    
    .form-group.error .underline {
        background: #ff4757 !important;
        width: 100% !important;
    }
    
    .form-group.error i {
        color: #ff4757 !important;
    }
    
    .form-group.error label {
        color: #ff4757 !important;
    }
`;
document.head.appendChild(style);