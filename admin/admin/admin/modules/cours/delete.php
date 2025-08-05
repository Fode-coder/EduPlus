<?php
require_once '../../../includes/auth.php';
require_once '../../../includes/db.php';
require_once '../../../includes/helpers.php';

header('Content-Type: application/json');

try {
    $id = $_GET['id'] ?? 0;
    
    // Vérifier si le cours existe
    $stmt = $pdo->prepare("SELECT * FROM documents_college WHERE id = ? AND type_doc = 'cours'");
    $stmt->execute([$id]);
    $cours = $stmt->fetch();
    
    if (!$cours) {
        throw new Exception("Cours non trouvé");
    }
    
    // Supprimer le fichier associé
    if ($cours['fichier_url'] && file_exists('../../../' . $cours['fichier_url'])) {
        unlink('../../../' . $cours['fichier_url']);
    }
    
    // Supprimer le cours
    $stmt = $pdo->prepare("DELETE FROM documents_college WHERE id = ?");
    $stmt->execute([$id]);
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}