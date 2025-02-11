<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../Database.php';
include_once 'Project.php';

$database = new Database();
$db = $database->getConnection();

$project = new Project($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $project->title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $project->description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
    $project->image = htmlspecialchars($_POST['image'], ENT_QUOTES, 'UTF-8');

    if ($project->create()) {
        echo "Le projet a été créé avec succès.";
    } else {
        echo "Impossible de créer le projet.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/back.css" />

    
    <title>Créer un Projet</title>
    
</head>
<body>

    <div class="container">
        <h2>Créer un Nouveau Projet</h2>
        <form action="create_project.php" method="POST" enctype="multipart/form-data">
            <label for="title">Titre du Projet</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description du Projet</label>
            <textarea id="description" name="description" required></textarea>

            <label for="image">Image du Projet</label>
            <input type="file" id="image" name="image" required>

            <button type="submit">Créer le Projet</button>
        </form>

        <?php
        // Afficher un message de succès ou d'erreur après la soumission du formulaire
        if (isset($_GET['message'])) {
            echo "<div class='message'>" . htmlspecialchars($_GET['message']) . "</div>";
        }
        ?>
    </div>

</body>
</html>
