<?php
$servername = "localhost";
$username = "ton_utilisateur"; // Remplace par ton nom d'utilisateur MySQL
$password = "ton_mot_de_passe"; // Remplace par ton mot de passe MySQL
$dbname = "guestbook_db"; // Le nom de ta base de données

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}
echo "Connexion réussie";
?>

