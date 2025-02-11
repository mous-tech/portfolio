<?php
require_once "../Database.php";  

$database = new Database();
$conn = $database->conn;

// Définir le nouvel utilisateur et mot de passe
$username = "mouska";
$new_password = "Kayzer801"; // Nouveau mot de passe à enregistrer

// Hasher le mot de passe
$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

// Vérifier si l'utilisateur existe déjà
$sql_check = "SELECT * FROM connect WHERE username = :username";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bindParam(':username', $username, PDO::PARAM_STR);
$stmt_check->execute();

if ($stmt_check->rowCount() > 0) {
    // Mise à jour du mot de passe
    $sql_update = "UPDATE connect SET password = :password WHERE username = :username";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $stmt_update->bindParam(':username', $username, PDO::PARAM_STR);

    if ($stmt_update->execute()) {
        echo "✅ Mot de passe mis à jour avec succès !";
    } else {
        echo "❌ Erreur lors de la mise à jour du mot de passe.";
    }
} else {
    // Créer l'utilisateur s'il n'existe pas
    $sql_insert = "INSERT INTO connect (username, password) VALUES (:username, :password)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt_insert->bindParam(':password', $hashed_password, PDO::PARAM_STR);

    if ($stmt_insert->execute()) {
        echo "✅ Utilisateur créé avec succès !";
    } else {
        echo "❌ Erreur lors de la création de l'utilisateur.";
    }
}
?>
