

<?php
// Informations de connexion à la base de données
define('DB_HOST', 'localhost'); // Adresse du serveur MySQL
define('DB_NAME', 'crud'); // Nom de votre base de données
define('DB_USER', 'root'); // Nom d'utilisateur MySQL
define('DB_PASSWORD', ''); // Mot de passe MySQL

// Options de connexion PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Gestion des erreurs avec des exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Récupération des résultats sous forme de tableau associatif
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // Jeu de caractères UTF-8
];

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);
} catch (PDOException $e) {
    // En cas d'erreur, affichage du message d'erreur
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    die(); // Arrêt du script
}