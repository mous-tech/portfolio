<?php
session_start();  // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css" />

    <title>showUser</title>
</head>
<body>
<main>
    <div class="link_container">
        <a class="link_container" href="addUser.php">Ajouter un utilisateur</a>
    </div>
    <table>
        <thead>
            <?php
            require_once "../Database.php";  // Assurez-vous que ce chemin est correct

            // Créer une instance de la classe Database
            $database = new Database();
            $conn = $database->conn;  // Récupérer la connexion PDO

            try {
                // Liste des utilisateurs avec PDO
                $sql = "SELECT * FROM users";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                // Vérifier s'il y a des utilisateurs
                if ($stmt->rowCount() > 0) {
                    ?>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Affichage des utilisateurs
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nom']) ?></td>
                            <td><?= htmlspecialchars($row['prenom']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['message']) ?></td>
                            <td class="image"><a href="modifyUser.php?id=<?= $row['id'] ?>"><img src="../assets/img/pencil.png" alt="Modifier" width="50px"></a></td>
                            <td class="image"><a href="delete.php?id=<?= $row['id'] ?>"><img src="../assets/img/croix.jpg" alt="Supprimer" width="50px"></a></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<p class='message'>0 utilisateur présent !</p>";
                }
            } catch (PDOException $e) {
                echo "Erreur de connexion ou de requête : " . $e->getMessage();
            }
            ?>
            <a href="logout.php">Déconnexion</a>


             
            
        </tbody>
    </table>
</main>
    
</body>
</html>
