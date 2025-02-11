<?php
// Récupérer l'ID de l'utilisateur passé par URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    // Si l'ID n'est pas présent ou n'est pas un nombre valide, afficher un message d'erreur
    echo "L'ID de l'utilisateur est invalide ou manquant.";
    exit();
}

// Inclure la classe Database pour se connecter à la base de données
require_once "../Database.php";  

// Créer une instance de la classe Database
$database = new Database();
$conn = $database->conn;  // Récupérer la connexion PDO

// Préparer la requête SELECT pour récupérer les données de l'utilisateur
$sql = "SELECT * FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

// Exécuter la requête
$stmt->execute();

// Vérifier si l'utilisateur existe
if ($stmt->rowCount() > 0) {
    // Récupérer les données de l'utilisateur
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Utilisateur non trouvé";
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css" />
    <title>Modifier</title>
</head>
<body>
    <form action="" method="POST">
        <h1>Modifier un utilisateur</h1>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($row['nom']); ?>" placeholder="Nom">
        <input type="text" name="prenom" value="<?php echo htmlspecialchars($row['prenom']); ?>" placeholder="Prénom">
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" placeholder="Email">
        <input type="submit" name="send" value="Modifier">
        <a class="link back" href="showUser.php">Annuler</a>
    </form>

    <?php
    // Traitement du formulaire de modification
    if (isset($_POST['send'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];

        // Préparer la requête de mise à jour
        $update_sql = "UPDATE users SET nom = :nom, prenom = :prenom, email = :email WHERE id = :user_id";
        $update_stmt = $conn->prepare($update_sql);
        
        // Lier les paramètres
        $update_stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $update_stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $update_stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $update_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        // Exécuter la requête de mise à jour
        if ($update_stmt->execute()) {
            echo "Utilisateur modifié avec succès!";
            header("Location: showUser.php?message=ModificationSuccess");
            exit();
        } else {
            echo "Erreur lors de la modification de l'utilisateur.";
        }
    }
    ?>
</body>
</html>
