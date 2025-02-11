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
    $project->title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $project->description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
    $project->image = htmlspecialchars($_POST['image'], ENT_QUOTES, 'UTF-8');

    if ($project->update()) {
        echo "Le projet a été mis à jour.";
    } else {
        echo "Impossible de mettre à jour le projet.";
    }
}
?>