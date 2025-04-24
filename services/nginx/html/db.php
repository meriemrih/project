<?php
// Configuration de la base de données
$host = 'db';  // Nom du service MySQL défini dans Docker
$dbname = 'sonalgaz_db';  // Nom de la base de données
$username = 'root';  // Nom d'utilisateur MySQL
$password = 'root';  // Mot de passe MySQL
$charset = 'utf8mb4';  // Encodage UTF-8 complet

// Options PDO pour une connexion sécurisée et optimisée
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Active le mode exception pour les erreurs
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // Retourne des tableaux associatifs
    PDO::ATTR_EMULATE_PREPARES => false,  // Désactive l'émulation des requêtes préparées pour la sécurité
];

try {
    // Création de la connexion PDO
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $username, $password, $options);

} catch (PDOException $e) {
    // Affichage d'une erreur en cas d'échec de connexion
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

