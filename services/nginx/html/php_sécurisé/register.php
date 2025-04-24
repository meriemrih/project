<?php
// Démarre une nouvelle session ou reprend une session existante
session_start();

// Inclusion du fichier de connexion à la base de données
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire et suppression des espaces superflus
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Vérification que le nom d'utilisateur ne contient que des caractères valides (lettres, chiffres, underscores)
    if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        die("Nom d'utilisateur invalide !");
    }

    // Vérification de la validité de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse e-mail invalide !");
    }

    // Vérification de la complexité du mot de passe (minimum 8 caractères, majuscules, minuscules, chiffres)
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
        die("Le mot de passe doit contenir au moins 8 caractères, avec des lettres et des chiffres.");
    }

    // Hachage sécurisé du mot de passe avant stockage en base de données
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Préparation de la requête SQL avec requête préparée pour éviter l'injection SQL
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

    // Exécution de la requête avec les valeurs fournies
    if ($stmt->execute([$username, $email, $hashed_password])) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>

