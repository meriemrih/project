<?php
session_start();
require 'db.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION["username"])) {
    header("Location: index.html");
    exit;
}

// Récupération des infos de l'utilisateur
$username = $_SESSION["username"];
$query = "SELECT * FROM users WHERE username = :username";
$stmt = $pdo->prepare($query);
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST["username"];
    $new_email = $_POST["email"];
    $new_password = $_POST["password"];

    $update_query = "UPDATE users SET username = :new_username, email = :new_email, password = :new_password WHERE username = :old_username";
    $update_stmt = $pdo->prepare($update_query);
    $update_stmt->execute([
        'new_username' => $new_username,
        'new_email' => $new_email,
        'new_password' => $new_password, // Mot de passe en clair
        'old_username' => $username
    ]);

    $_SESSION["username"] = $new_username;
    echo "<script>alert('Profil mis à jour avec succès !'); window.location.href='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier mon profil</title>
    <link rel="stylesheet" href="style.css">
    <style>
.profile-container {
width: 400px;
margin: 100px auto;
background: #333;
padding: 30px;
border-radius: 10px;
text-align: center;
color: white;
box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
background: linear-gradient(to top, rgba(0,0,0,0.8)50%,rgba(0,0,0,0.8)50%);
font-family: Arial;
}
.profile-container h2 {
margin-bottom: 20px;
color: #ff7200;
}
.profile-container input {
width: 350px;
padding: 10px;
border: none;
border-radius: 5px;
margin: 10px 0;
background: #222;
color: white;
font-size: 16px;
}
.profile-container .btnn {
width: 373px;
padding: 10px;
margin-top: 10px;
background: #ff7200;
border: none;
border-radius: 5px;
color: white;
font-size: 18px;
cursor: pointer;
transition: 0.3s;
        }
.profile-container .btnn:hover {
background: white;
color: #ff7200;
        }
    </style>
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">SONALGAZ</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="dashboard.php">HOME</a></li>
                    <li><a href="#">ABOUT</a></li>
                    <li><a href="#">SERVICES</a></li>
                    <li><a href="#">PROJECTS</a></li>
                    <li><a href="#">CONTACT</a></li>
                </ul>
            </div>
            <div class="search">
                <input class="srch" type="search" name="" placeholder="Type To text">
                <a href="#"> <button class="btn">Search</button></a>
            </div>
        </div> 

        <div class="content">
            <div class="profile-container">
                <h2>Edit my profile</h2>
                <form action="profile.php" method="post">
                    <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    <input type="password" name="password" placeholder="Nouveau mot de passe">
                    <button class="btnn" type="submit"> <b>Update</b></button>
                    <button class="btnn"><a href="dashboard.php" style="color: white; text-decoration: none;">back</a></button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

