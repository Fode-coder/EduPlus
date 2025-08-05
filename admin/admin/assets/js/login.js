document.addEventListener('DOMContentLoaded', function () {
    // Toggle password visibility
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    }

    // Form validation and submission
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = this.querySelector('.btn-premium');
            const loader = submitBtn.querySelector('.loader');
            const btnText = submitBtn.querySelector('span');

            // Show loader
            btnText.style.opacity = '0';
            loader.style.display = 'block';

            // Simulate loading (remove in production)
            setTimeout(() => {
                this.submit();
            }, 1500);
        });
    }

    // Input validation
    const emailInput = document.querySelector('input[name="email"]');
    if (emailInput) {
        emailInput.addEventListener('input', function () {
            const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value);
            this.style.borderBottomColor = isValid ? '#2ecc71' : 'rgba(245, 166, 35, 0.5)';
        });
    }
});

// Particules.js background (optional)
document.addEventListener('DOMContentLoaded', function () {
    const particlesSettings = {
        particles: {
            number: { value: 80, density: { enable: true, value_area: 800 } },
            color: { value: "#f5a623" },
            shape: { type: "circle" },
            opacity: { value: 0.5, random: true },
            size: { value: 3, random: true },
            line_linked: { enable: true, distance: 150, color: "#f5a623", opacity: 0.4, width: 1 },
            move: { enable: true, speed: 2, direction: "none", random: true, straight: false, out_mode: "out" }
        },
        interactivity: {
            detect_on: "canvas",
            events: {
                onhover: { enable: true, mode: "repulse" },
                onclick: { enable: true, mode: "push" }
            }
        }
    };

    if (typeof particlesJS !== 'undefined') {
        particlesJS('particles-background', particlesSettings);
    }
});