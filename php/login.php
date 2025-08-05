<?php
session_start();
require_once 'config.php';

// Traitement de la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mdp = $_POST['mdp'];

    $req = $pdo->prepare('SELECT * FROM membres_premium WHERE email = ?');
    $req->execute([$email]);
    $user = $req->fetch();

    if ($user && password_verify($mdp, $user['mdp_hash'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'prenom' => $user['prenom'],
            'nom' => $user['nom'],
            'email' => $user['email'],
            'statut' => $user['statut']
        ];
        
        // Redirection vers l'espace membre
        header('Location: ../html/communaute.php');
        exit();
    } else {
        $error = "Identifiants incorrects";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | EduPlus Premium</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="particles" id="particles-js"></div>
    
    <div class="container">
        <div class="glass-card">
            <div class="header">
                <img src="images/logo-premium.png" alt="EduPlus Premium" class="logo">
                <h1>Connexion</h1>
                <p>Accédez à votre espace membre</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <p><?= $error ?></p>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" id="loginForm">
                <div class="form-group floating">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                    <i class="fas fa-envelope"></i>
                </div>

                <div class="form-group floating">
                    <input type="password" id="mdp" name="mdp" required>
                    <label for="mdp">Mot de passe</label>
                    <i class="fas fa-lock"></i>
                </div>

                <div class="form-group options">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        <span>Se souvenir de moi</span>
                    </label>
                    <a href="mot-de-passe-oublie.php" class="forgot">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="submit-btn magnetic">
                    <span>Se connecter</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <div class="register-link">
                    <p>Pas encore membre ? <a href="inscription.php">Créer un compte</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="../js/login.js"></script>
</body>
</html>