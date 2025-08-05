<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('Location: admin/dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPlus Admin - Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="branding">
            <div class="logo-shine">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h1>EduPlus <span>Admin</span></h1>
            <p>Plateforme de gestion éducative</p>
        </div>

        <form id="loginForm" action="includes/auth.php" method="POST">
            <?php if (isset($_GET['error'])): ?>
                <div class="alert error"><?= htmlspecialchars($_GET['error']) ?></div>
            <?php endif; ?>

            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Adresse email" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <span class="toggle-password"><i class="fas fa-eye"></i></span>
            </div>

            <button type="submit" class="btn-premium">
                <span>Connexion</span>
                <div class="loader"></div>
            </button>
        </form>

        <div class="login-footer">
            <p>© 2024 EduPlus | <a href="#">Support technique</a></p>
        </div>
    </div>

    <div class="particles-background"></div>

    <script src="assets/js/login.js"></script>
</body>

</html>