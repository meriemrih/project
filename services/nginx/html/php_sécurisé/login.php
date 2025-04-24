<?php
// Démarre une session pour stocker les informations de l'utilisateur connecté
session_start();

// Inclusion du fichier contenant la connexion à la base de données
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire avec suppression des espaces superflus
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Vérification que le nom d'utilisateur est valide
    if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        die("Nom d'utilisateur invalide !");
    }

    // Protection contre les attaques par force brute : Limite le nombre de tentatives de connexion
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    // Si plus de 3 tentatives ont échoué, bloquer temporairement l'utilisateur
    if ($_SESSION['login_attempts'] >= 3) {
        die("Trop de tentatives. Veuillez réessayer plus tard.");
    }

    // Préparer la requête pour récupérer l'utilisateur avec un nom d'utilisateur donné
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Vérification du mot de passe avec password_verify()
    if ($user && password_verify($password, $user["password"])) {
        // Si les informations sont correctes, stocker le nom d'utilisateur en session
        $_SESSION["username"] = $user["username"];
        $_SESSION['login_attempts'] = 0; // Réinitialiser le compteur des tentatives de connexion
        echo "Connexion réussie ! Bienvenue, " . htmlspecialchars($user["username"]);
    } else {
        // Augmenter le compteur des tentatives de connexion en cas d'échec
        $_SESSION['login_attempts']++;
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

