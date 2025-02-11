<?php
session_start();  // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if(isset($_POST['send'])){
    if(isset($_POST['nom']) &&
      isset($_POST['prenom'])&&
      isset($_POST['email'])&&
      $_POST['nom'] != "" &&
      $_POST['prenom'] != ""
    ){
        require_once "../Database.php";
        extract($_POST);

        $sql = "INSERT INTO users (nom,prenom,email) VALUES ('$nom,$prenom,$email')";
        if (mysqli_query($conn,$sql)){
            header("location:showUser.php");
        }else {
            header("location:addUser.php?message=Addfail");
        }
    }else{
        header("location:addUser.php?message=EmptyFields");
    }
}


?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css" />

    <title>Ajouter</title>
</head>
<body>
    <form action="" method="POST">
        <h1>Ajouter un utilisateur</h1>
        <input type="text" name="nom" value = "" placeholder="Nom">
        <input type="text" name="Prenom" value = "" placeholder="Prénom">
        <input type="email" name="email" value = "" placeholder="Email">
        <input type="submit" name="send" value = "Ajouter" placeholder="Email">
        <a class="link back " href="showuser.php">Annuler</a>
        
    </form>
    
</body>
</html>