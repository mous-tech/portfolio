<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../Database.php';
include_once 'Project.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['project_id']) && is_numeric($_POST['project_id'])) {
    $database = new Database();
    $db = $database->getConnection();

    $projectId = intval($_POST['project_id']);
    $project = new Project($db);
    $project->id = $projectId;

    if ($project->delete()) {
        echo "Le projet a été supprimé.";
    } else {
        echo "Impossible de supprimer le projet.";
    }
} else {
    echo "Accès non autorisé.";
}
?>

<form action="delete_project.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ? Cette action est irréversible.')">
    <label for="project_id">ID du Projet :</label>
    <input type="number" id="project_id" name="project_id" required>
    <button type="submit">Supprimer</button>
</form>
