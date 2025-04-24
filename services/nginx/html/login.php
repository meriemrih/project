<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données (sans validation ni filtrage)
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Requête SQL directe (VULNÉRABLE À L'INJECTION SQL)
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $pdo->query($query);
    $user = $result->fetch();

    if ($user) {
        $_SESSION["username"] = $user["username"];
        // echo "Connexion réussie ! Bienvenue, " . $user["username"]; // VULNÉRABLE À XSS
        header("Location: dashboard.php"); // Redirige vers la page d'accueil personnalisée
        exit;
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

