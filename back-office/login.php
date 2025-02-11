<?php
session_start();  // Démarrer la session

// Si l'utilisateur est déjà connecté, le rediriger vers showUser.php
if (isset($_SESSION['user_id'])) {
    header("Location: showUser.php");
    exit();
}

// Vérifier si le formulaire est soumis
if (isset($_POST['login'])) {
    require_once "../Database.php";  // Inclure la connexion PDO

    $database = new Database();
    $conn = $database->conn;

    // Récupérer les données du formulaire
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Vérifier si les champs ne sont pas vides
    if (!empty($username) && !empty($password)) {
        // Récupérer l'utilisateur en base de données
        $sql = "SELECT * FROM connect WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // Vérifier si l'utilisateur existe
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $hash = $user['password'];  // Récupérer le hash enregistré

            // 🔍 DEBUG : Affichage des valeurs pour comprendre l'erreur
            echo "<pre>";
            echo "Mot de passe entré : '" . $password . "'\n";
            echo "Hash récupéré en base : '" . $hash . "'\n";

            // Vérifier le mot de passe
            if (password_verify($password, $hash)) {
                echo "✅ Succès : password_verify() fonctionne !\n";
                echo "</pre>";
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Rediriger vers showUser.php
                header("Location: showUser.php");
                exit();
            } else {
                echo "❌ Erreur : password_verify() a échoué.\n";
                echo "</pre>";
                $error = "Mot de passe incorrect.";
            }
        } else {
            $error = "Utilisateur non trouvé.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Se connecter</h1>
    <form method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" name="login" value="Se connecter">
    </form>

    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
</body>
</html>
