<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h1>Login</h1>
        <form action="" method="POST">
            Email: <input type="email" name="email" required><br>
            Mot de passe: <input type="password" name="mdp" required><br>
            <button type="submit" name="submit">Se connecter</button>
        </form>
    </div>

    <?php
    session_start();

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        if (preg_match("/@emsi\.ma$/", $email)) {
            $_SESSION['email'] = $email;
            header("Location: home.php");
            exit();
        } else {
            echo "<div class='message'>L'email doit se terminer par @emsi.ma.</div>";
        }
    }
    ?>
</body>
</html>