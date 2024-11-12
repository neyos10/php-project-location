<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Utilisateur</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        img.logo {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo">
        <h1>Créer un Utilisateur</h1>
        <form action="" method="POST">
            Nom: <input type="text" name="nom" required><br>
            Prénom: <input type="text" name="prenom" required><br>
            Email: <input type="email" name="email" required><br>
            Mot de passe: <input type="password" name="mdp" required><br>
            Confirmer le mot de passe: <input type="password" name="mdp_confirmer" required><br>
            <button type="submit" name="submit">Sign Up</button>
        </form>

        <?php
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "testDb";

        $conn = mysqli_connect($servername, $username, $password, $dbName);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Vérification de la soumission du formulaire
        if (isset($_POST['submit'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];
            $mdp_confirmer = $_POST['mdp_confirmer'];

            // Validation de l'email et des mots de passe
            if (!preg_match("/@emsi\.ma$/", $email)) {
                echo "<div class='message'>L'email doit se terminer par @emsi.ma</div>";
            } elseif ($mdp !== $mdp_confirmer) {
                echo "<div class='message'>Les mots de passe ne correspondent pas.</div>";
            } elseif (strlen($mdp) < 8) {
                echo "<div class='message'>Le mot de passe doit contenir au moins 8 caractères.</div>";
            } 
            elseif (!preg_match("/[A-Z]/", $mdp)) {
                $message = "Le mot de passe doit contenir au moins une majuscule.";
            } elseif (!preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $mdp)) {
                $message = "Le mot de passe doit contenir au moins un caractère spécial.";
            }else {
                // Vérifier si l'email existe déjà
                $stmt = $conn->prepare("SELECT * FROM Clients WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<div class='message'>Cet email est déjà utilisé. Veuillez en choisir un autre.</div>";
                } else {
                    // Hacher le mot de passe
                    $hashed_password = password_hash($mdp, PASSWORD_DEFAULT);

                    // Insérer dans la base de données
                    $stmt = $conn->prepare("INSERT INTO Clients (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $nom, $prenom, $email, $hashed_password);

                    if ($stmt->execute()) {
                        echo "<div class='message'>Utilisateur créé avec succès !</div>";
                        header("Location: /tp3/login.php");
                        exit();
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                }

                // Fermer l'instruction
                $stmt->close();
            }
        }

        // Fermer la connexion
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>