<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username,
$password);
if (!$conn)
 {
die("Connection failed: " .
mysqli_connect_error());
}
echo "Connected successfully<br>";

// Vérifier si la base de données existe
$dbName = "testDb";
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";

if (mysqli_query($conn, $sql)) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Sélectionner la base de données
if (mysqli_select_db($conn, $dbName)) {
    echo "Database selected successfully<br>";
} else {
    echo "Error selecting database: " . mysqli_error($conn) . "<br>";
}

// Créer la table Clients
$query = "
CREATE TABLE IF NOT EXISTS Clients (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50) UNIQUE,
    password VARCHAR(80),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $query)) {
    echo "Table Clients created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// Fermer la connexion
mysqli_close($conn);
?>