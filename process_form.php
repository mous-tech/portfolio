<?php

session_start();
require_once "Database.php";
$db = new Database();
$conn = $db->conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $email = trim($_POST["mail"]);
    $message = trim($_POST["message"]);

    // Validation des champs
    if (empty($nom) || empty($prenom) || empty($email) || empty($message)) {
        $_SESSION["error"] = "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "L'adresse e-mail est invalide.";
    } else {
        // Insertion dans la base de données
        $stmt = $conn->prepare("INSERT INTO users (nom, prenom, email, message) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nom, $prenom, $email, $message])) {
            $_SESSION["success"] = "Message envoyé avec succès.";
        } else {
            $_SESSION["error"] = "Une erreur est survenue lors de l'envoi.";
        }
    }
    header("Location: index.php");
    exit;
}