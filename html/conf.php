<?php
// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'eduplus');
define('DB_USER', 'root');
define('DB_PASS', 'Keyassane1000');

// Configuration de l'application
define('APP_ROOT', dirname(__DIR__));
define('APP_URL', 'https://votre-domaine.com');
define('DEBUG_MODE', false);

// Initialisation de la session sécurisée
/*session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'domain' => 'votre-domaine.com',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);*/

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => true
        ]
    );
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Une erreur est survenue lors de la connexion à la base de données.");
}

// Fonctions utilitaires
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function isAuthenticated() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']['id']);
}

function redirectIfNotAuthenticated() {
    if (!isAuthenticated()) {
        header('Location: /connexion.php?redirect=' . basename($_SERVER['PHP_SELF']));
        exit();
    }
}

// CSRF Protection
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function verifyCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}