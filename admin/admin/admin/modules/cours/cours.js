document.addEventListener('DOMContentLoaded', function() {
    // Initialisation du modal
    const coursModal = new bootstrap.Modal(document.getElementById('coursModal'));
    const coursForm = document.getElementById('coursForm');
    const fileInput = document.getElementById('fichier');
    const filePreview = document.getElementById('filePreview');
    const uploadArea = document.getElementById('uploadArea');

    // Gestion de l'upload de fichiers
    if (uploadArea && fileInput) {
        uploadArea.addEventListener('click', () => fileInput.click());
        
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];
                if (file.type === 'application/pdf') {
                    filePreview.innerHTML = `
                        <i class="fas fa-times-circle remove-file"></i>
                        <span>${file.name}</span>
                    `;
                    filePreview.style.display = 'flex';
                    
                    filePreview.querySelector('.remove-file').addEventListener('click', function(e) {
                        e.stopPropagation();
                        fileInput.value = '';
                        filePreview.style.display = 'none';
                    });
                } else {
                    showAlert('Veuillez sélectionner un fichier PDF', 'error');
                }
            }
        });
    }

    // Bouton d'ajout
    document.querySelector('.btn-add').addEventListener('click', function() {
        document.getElementById('modalTitle').innerHTML = '<i class="fas fa-book"></i> Ajouter un cours';
        coursForm.reset();
        if (filePreview) filePreview.style.display = 'none';
        coursModal.show();
    });

    // Boutons d'édition
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const card = this.closest('.cours-card');
            const titre = card.querySelector('h3').textContent;
            const matiere = card.querySelector('.matiere').textContent;
            const niveau = card.querySelector('.classe').textContent;
            const description = card.querySelector('.description').textContent;

            document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit"></i> Modifier le cours';
            document.getElementById('coursId').value = id;
            document.getElementById('titre').value = titre;
            document.getElementById('matiere').value = matiere;
            document.getElementById('niveau').value = niveau;
            document.getElementById('description').value = description.trim();
            
            if (filePreview) filePreview.style.display = 'none';
            coursModal.show();
        });
    });

    // Boutons de suppression
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const card = this.closest('.cours-card');
            
            if (confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')) {
                fetch(`delete.php?id=${id}`, { 
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        card.style.opacity = '0';
                        setTimeout(() => {
                            card.style.height = '0';
                            card.style.margin = '0';
                            card.style.padding = '0';
                            setTimeout(() => card.remove(), 300);
                        }, 300);
                        showAlert('Cours supprimé avec succès', 'success');
                    } else {
                        showAlert('Erreur lors de la suppression', 'error');
                    }
                })
                .catch(error => {
                    showAlert('Erreur réseau', 'error');
                });
            }
        });
    });

    // Soumission du formulaire
    if (coursForm) {
        coursForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const id = formData.get('id');
            const method = id ? 'PUT' : 'POST';
            const url = id ? `update.php?id=${id}` : 'create.php';
            
            const submitBtn = this.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
            submitBtn.disabled = true;
            
            fetch(url, {
                method: method,
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(id ? 'Cours mis à jour' : 'Cours créé', 'success');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showAlert(data.message || 'Une erreur est survenue', 'error');
                }
            })
            .catch(error => {
                showAlert('Erreur réseau: ' + error.message, 'error');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }

    // Fonction pour afficher les alertes
    function showAlert(message, type) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type}`;
        alert.innerHTML = `
            <div class="alert-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
            <i class="fas fa-times close-alert"></i>
        `;
        
        document.body.appendChild(alert);
        
        setTimeout(() => {
            alert.classList.add('show');
        }, 10);
        
        alert.querySelector('.close-alert').addEventListener('click', () => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 300);
        });
        
        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    }
});