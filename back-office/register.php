<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../Database.php";  

$database = new Database();
$conn = $database->conn;

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password_plain = $_POST['password'];
    $password_hashed = password_hash($password_plain, PASSWORD_BCRYPT);  

    if (!empty($username) && !empty($password_plain)) {
        $sql = "INSERT INTO connect (username, password) VALUES (:username, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password_hashed, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Utilisateur enregistré avec succès. <br>";
            echo "Mot de passe haché enregistré : $password_hashed"; // Permet de voir ce qui est stocké
        } else {
            echo "Erreur lors de l'inscription.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Créer un compte</h1>
    <form method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" name="register" value="S'inscrire">
    </form>
</body>
</html>
