<?php
$host = "vivaldi.o2switch.net"; // Ou l'adresse de ton serveur MySQL
$user = "famo2256";
$pass = "bDX7-KUfH-C9f)";
$db = "famo2256_cpanel";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
} else {
    echo "Connexion réussie !";
}


?>
