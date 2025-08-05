<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Limiter les tentatives de connexion
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    if ($_SESSION['login_attempts'] >= 5) {
        header('Location: ../login.php?error=Trop de tentatives. Veuillez réessayer plus tard.');
        exit();
    }

    // Vérification des identifiants
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        // Connexion réussie
        $_SESSION['admin'] = [
            'id' => $admin['id'],
            'email' => $admin['email'],
            'name' => $admin['name']
        ];
        $_SESSION['login_attempts'] = 0;
        header('Location: ../admin/dashboard.php');
        exit();
    } else {
        // Échec de connexion
        $_SESSION['login_attempts']++;
        header('Location: ../login.php?error=Email ou mot de passe incorrect');
        exit();
    }
}
