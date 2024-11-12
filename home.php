<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$username = explode('@', $email)[0]; // Récupérer la partie avant '@emsi.ma'

// Déconnexion
if (isset($_POST['logout'])) {
    session_destroy(); // Détruire la session
    header("Location: login.php"); // Rediriger vers la page de connexion
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="styles.css"> <!-- Lien vers le fichier CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            padding: 10px 0;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar .logout {
            float: right; /* Aligner le bouton de déconnexion à droite */
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .apartment-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .apartment {
            background: #e9ecef;
            border-radius: 5px;
            padding: 15px;
            margin: 10px;
            width: calc(30% - 20px);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .apartment h2 {
            margin: 0 0 10px;
        }

        .apartment p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#">Bienvenue, <?php echo htmlspecialchars($username); ?></a>
        <form class="logout" action="" method="POST">
            <button type="submit" name="logout" style="background: none; border: none; color: white; cursor: pointer;">Déconnexion</button>
        </form>
    </div>

    <div class="container">
        <h1>Page d'Accueil</h1>
        <p>Voici quelques appartements disponibles :</p>
        <div class="apartment-list">
            <div class="apartment">
                <h2>Appartement 1</h2>
                <p>Localisation: Paris</p>
                <p>Prix: 1200€/mois</p>
            </div>
            <!-- Ajoutez d'autres appartements ici -->
        </div>
    </div>
</body>
</html>
