<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
     <style>
/* Dashboard: boutons en bas avec espacement */
.dashboard-buttons {
    position: absolute;
    bottom: 20px;
    top: 50%;
    left: 25%;
    transform: translateX(-50%);
    display: flex;
    gap: 40px; /* Augmente l'espace entre les boutons */
    margin-top: 10px;
}

.dashboard-buttons .btnn {
    width: 200px;
    text-align: center;
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
            <h1>Welcome, <?php echo $_SESSION["username"]; ?>👋!</h1>
            <p class="par">You have successfully logged in. What would you like to do?</p>

            <div class="dashboard-buttons">
                <button class="btnn" style="margin-left: 20px;"><a href="profile.php" style="color: white; text-decoration: none;">Edit my profile</a></button>
                <button class="btnn" style="margin-left: 150px;"><a href="logout.php" style="color: white; text-decoration: none;">Log out</a></button>
            </div>
        </div>
    </div>

</body>
</html>

