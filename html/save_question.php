<?php
session_start();
require_once '../php/config.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    die(json_encode(['status' => 'error', 'message' => 'Non autorisé']));
}

// Vérifier le token CSRF (à implémenter selon votre système)
// if (!verifyCsrfToken($_POST['csrf_token'])) {...}

try {
    // Commencer une transaction
    $pdo->beginTransaction();

    // 1. Insérer la question principale
    $stmt = $pdo->prepare("
        INSERT INTO questions (titre, contenu, auteur_id, matiere_id, date_creation)
        VALUES (:titre, :contenu, :auteur_id, :matiere_id, NOW())
    ");
    
    $stmt->execute([
        ':titre' => htmlspecialchars($_POST['titre']),
        ':contenu' => htmlspecialchars($_POST['contenu']),
        ':auteur_id' => $_SESSION['user']['id'],
        ':matiere_id' => intval($_POST['matiere_id'])
    ]);
    
    $questionId = $pdo->lastInsertId();


    // Valider la transaction
    $pdo->commit();

    // Rediriger vers la page de la question ou actualiser
    header('Location: communaute.php#questions');
    exit();

} catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Erreur lors de l'enregistrement: " . $e->getMessage());
    die(json_encode(['status' => 'error', 'message' => 'Erreur de base de données']));
}