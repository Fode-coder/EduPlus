<?php
require_once '../../../includes/auth.php';
require_once '../../../includes/db.php';
require_once '../../../includes/helpers.php';

header('Content-Type: application/json');

parse_str(file_get_contents("php://input"), $_PUT);

try {
    $id = $_GET['id'] ?? 0;
    $data = json_decode(file_get_contents('php://input'), true);
    
    $titre = $data['titre'] ?? '';
    $matiere = $data['matiere'] ?? '';
    $niveau = $data['niveau'] ?? '';
    $description = $data['description'] ?? '';
    
    // Vérifier si le cours existe
    $stmt = $pdo->prepare("SELECT * FROM documents_college WHERE id = ? AND type_doc = 'cours'");
    $stmt->execute([$id]);
    $cours = $stmt->fetch();
    
    if (!$cours) {
        throw new Exception("Cours non trouvé");
    }
    
    // Mise à jour des données
    $stmt = $pdo->prepare("UPDATE documents_college SET titre = ?, matiere = ?, niveau = ?, description = ? WHERE id = ?");
    $stmt->execute([$titre, $matiere, $niveau, $description, $id]);
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}