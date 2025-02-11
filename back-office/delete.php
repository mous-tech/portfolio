<?php
// Assurez-vous que l'ID est bien passé par GET
$_user_id = $_GET['id'];

// Inclure la classe Database pour établir la connexion
require_once "../Database.php";  // Assurez-vous que ce chemin est correct

try {
    // Créer une instance de la classe Database
    $database = new Database();
    $conn = $database->conn;  // Récupérer la connexion PDO

    // Préparer la requête DELETE avec un paramètre pour l'ID de l'utilisateur
    $sql = "DELETE FROM users WHERE id = :user_id";
    
    // Préparer la requête
    $stmt = $conn->prepare($sql);
    
    // Lier le paramètre 'user_id' à la valeur de $_user_id
    $stmt->bindParam(':user_id', $_user_id, PDO::PARAM_INT);
    
    // Exécuter la requête
    if ($stmt->execute()) {
        // Redirection en cas de succès
        header("Location: showUser.php?message=DeleteSuccess");
    } else {
        // Redirection en cas d'échec
        header("Location: showUser.php?message=DeleteFail");
    }
} catch (PDOException $e) {
    // Gestion des erreurs : redirection en cas d'erreur
    echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
    header("Location: showUser.php?message=DeleteFail");
}
?>
