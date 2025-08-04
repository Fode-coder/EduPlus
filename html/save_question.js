// Gestion du formulaire de question
const questionForm = document.getElementById('new-question-form');
if (questionForm) {
    questionForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('.btn-submit');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Publication...';
        
        try {
            const response = await fetch('save_question.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.status === 'success') {
                // Recharger les questions ou rediriger
                window.location.reload();
            } else {
                alert(result.message || 'Erreur lors de la publication');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Une erreur est survenue');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Publier la question';
        }
    });
}