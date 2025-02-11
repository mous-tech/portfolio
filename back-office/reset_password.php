<?php
require_once "../Database.php";  

$database = new Database();
$conn = $database->conn;

$username = "mouska";
$password = "Kayzer801";

// Générer le bon hash
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Supprimer l'ancien utilisateur s'il existe
$sql_delete = "DELETE FROM connect WHERE username = :username";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bindParam(':username', $username, PDO::PARAM_STR);
$stmt_delete->execute();

// Insérer le nouvel utilisateur
$sql_insert = "INSERT INTO connect (username, password) VALUES (:username, :password)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bindParam(':username', $username, PDO::PARAM_STR);
$stmt_insert->bindParam(':password', $hashed_password, PDO::PARAM_STR);

if ($stmt_insert->execute()) {
    echo "✅ Utilisateur inséré avec succès.";
    echo "<br>Hash enregistré : " . $hashed_password;
} else {
    echo "❌ Erreur lors de l'insertion.";
}
?>

