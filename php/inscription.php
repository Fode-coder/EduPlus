<?php
// Connexion DB
require_once 'config.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $statut = $_POST['statut'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(32));
    $date_inscription = date('Y-m-d H:i:s');
    // Vérification email existant
    $check = $pdo->prepare('SELECT email FROM membres_premium WHERE email = ?');
    $check->execute([$email]);
    
    if ($check->rowCount() > 0) {
        header('Location: inscription.php?error=email_exists');
        exit();
    }

    // Insertion
    $insert = $pdo->prepare('INSERT INTO membres_premium(prenom, nom, email, mdp_hash, statut, date_inscription) VALUES(?,?,?,?,?,?)');
    $insert->execute([$prenom, $nom, $email, $mdp, $statut, $date_inscription]);

    // Envoi email
    $to = $email;
    $subject = "Confirmation d'inscription à EduPlus Premium";
    
    $message = "
    <html>
    <head>
        <style>
            body { font-family: 'Poppins', sans-serif; color: #333; }
            .header { background: linear-gradient(135deg, #6c5ce7, #00cec9); padding: 20px; color: white; text-align: center; }
            .content { padding: 30px; }
            .button { 
                display: inline-block; 
                padding: 12px 25px; 
                background: #6c5ce7; 
                color: white; 
                text-decoration: none; 
                border-radius: 50px; 
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>Bienvenue dans la communauté EduPlus Premium</h2>
        </div>
        <div class='content'>
            <p>Bonjour $prenom,</p>
            <p>Votre inscription en tant que <strong>$statut</strong> a bien été prise en compte.</p>
            <p>Accédez dès maintenant à votre espace membre :</p>
            <a href='https://votresite.com/verification.php?token=$token' class='button'>Activer mon compte</a>
            <p>À très vite sur notre plateforme !</p>
            <p>L'équipe EduPlus</p>
        </div>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From:assane6676@gmail.com\r\n";

    mail($to, $subject, $message, $headers);

    header('Location: login.php?success=1');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Premium | EduPlus</title>
    <link rel="stylesheet" href="../css/insc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="particles" id="particles-js"></div>
    
    <div class="container">
        <div class="glass-card">
            <div class="header">
                <img src="images/logo-premium.png" alt="EduPlus Premium" class="logo">
                <h1>Rejoindre la Communauté</h1>
                <p>Accédez aux contenus exclusifs</p>
            </div>

            <?php if (isset($_GET['success'])): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <p>Inscription réussie ! Vérifiez votre email pour activer votre compte.</p>
                </div>
            <?php endif; ?>

            <form action="inscription.php" method="POST" id="registerForm">
                <div class="form-group floating">
                    <input type="text" id="prenom" name="prenom" required>
                    <label for="prenom">Prénom</label>
                    <i class="fas fa-user"></i>
                </div>

                <div class="form-group floating">
                    <input type="text" id="nom" name="nom" required>
                    <label for="nom">Nom</label>
                    <i class="fas fa-id-card"></i>
                </div>

                <div class="form-group floating">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                    <i class="fas fa-envelope"></i>
                </div>

                <div class="form-group floating">
                    <input type="password" id="mdp" name="mdp" required minlength="8">
                    <label for="mdp">Mot de passe</label>
                    <i class="fas fa-lock"></i>
                    <div class="password-strength">
                        <span class="strength-bar"></span>
                        <span class="strength-text">Faible</span>
                    </div>
                </div>

                <div class="form-group radio-group">
                    <p class="radio-title">Statut :</p>
                    <div class="radio-options">
                        <label class="radio-card">
                            <input type="radio" name="statut" value="eleve" required>
                            <div class="radio-content">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Élève</span>
                            </div>
                        </label>
                        
                        <label class="radio-card">
                            <input type="radio" name="statut" value="professeur">
                            <div class="radio-content">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <span>Professeur</span>
                            </div>
                        </label>
                        
                        <label class="radio-card">
                            <input type="radio" name="statut" value="parent">
                            <div class="radio-content">
                                <i class="fas fa-user-friends"></i>
                                <span>Parent</span>
                            </div>
                        </label>
                        
                        <label class="radio-card">
                            <input type="radio" name="statut" value="etudiant">
                            <div class="radio-content">
                                <i class="fas fa-university"></i>
                                <span>Étudiant</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="form-group checkbox">
                    <input type="checkbox" id="rgpd" name="rgpd" required>
                    <label for="rgpd">J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a></label>
                </div>

                <button type="submit" class="submit-btn magnetic">
                    <span>Finaliser l'inscription</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="../js/ins.js"></script>
</body>
</html>