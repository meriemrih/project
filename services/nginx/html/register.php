<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire (sans validation ni filtrage)
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // Stocké en clair (non sécurisé)

    // Requête SQL directe (VULNÉRABLE À L'INJECTION SQL)
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    // Exécution de la requête
    if ($pdo->query($query)) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>

