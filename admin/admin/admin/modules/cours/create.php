<?php
require_once '../../../includes/auth.php';
require_once '../../../includes/db.php';
require_once '../../../includes/helpers.php';

header('Content-Type: application/json');

try {
    $titre = $_POST['titre'] ?? '';
    $matiere = $_POST['matiere'] ?? '';
    $niveau = $_POST['niveau'] ?? '';
    $description = $_POST['description'] ?? '';
    
    // Gestion du fichier uploadé
    $file = $_FILES['fichier'] ?? null;
    $filePath = '';
    
    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../../uploads/cours/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileName = uniqid() . '_' . basename($file['name']);
        $filePath = $uploadDir . $fileName;
        
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $filePath = 'uploads/cours/' . $fileName;
        } else {
            throw new Exception("Erreur lors de l'upload du fichier");
        }
    } else {
        throw new Exception("Fichier PDF requis");
    }
    
    $stmt = $pdo->prepare("INSERT INTO documents_college (titre, matiere, niveau, description, fichier, type_doc) VALUES (?, ?, ?, ?, ?, 'cours')");
    $stmt->execute([$titre, $matiere, $niveau, $description, $filePath]);
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}