<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Récupération des données
        $prenom = $_POST['prenom'] ?? '';
        $nom = $_POST['nom'] ?? '';
        $telephone = $_POST['telephone'] ?? '';
        $genre = $_POST['genre'] ?? '';
        $pays = $_POST['pays'] ?? '';
        $ville = $_POST['ville'] ?? '';
        $statut = $_POST['statut'] ?? '';

        // Validation
        $errors = [];
        
        if (empty($prenom)) $errors[] = "Le prénom est requis";
        if (empty($nom)) $errors[] = "Le nom est requis";
        if (empty($telephone)) $errors[] = "Le téléphone est requis";
        if (empty($genre)) $errors[] = "Le genre est requis";
        if (empty($pays)) $errors[] = "Le pays est requis";
        if (empty($ville)) $errors[] = "La ville est requise";
        if (empty($statut)) $errors[] = "Le statut est requis";

        if (!empty($errors)) {
            throw new Exception(implode("<br>", $errors));
        }

        // Insertion en BDD
        $sql = "INSERT INTO utilisateurs (prenom, nom, telephone, genre, pays, ville, statut, date_inscription) 
                VALUES (:prenom, :nom, :telephone, :genre, :pays, :ville, :statut, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':prenom' => htmlspecialchars($prenom),
            ':nom' => htmlspecialchars($nom),
            ':telephone' => htmlspecialchars($telephone),
            ':genre' => htmlspecialchars($genre),
            ':pays' => htmlspecialchars($pays),
            ':ville' => htmlspecialchars($ville),
            ':statut' => htmlspecialchars($statut)
        ]);

        // Redirection avec message de succès
        header("Location: login.php?success=1");
        exit();

    } catch (PDOException $e) {
        die("Erreur de base de données : " . $e->getMessage());
    } catch (Exception $e) {
        // Redirection avec erreurs
        header("Location: inscription.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: inscription.php");
    exit();
}