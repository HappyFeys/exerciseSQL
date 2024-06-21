<?php
session_start();
include 'auth.php';
checkUserLoggedIn();

try {
    // Connexion à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=rando;charset=utf8', 'root', '');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

if (!isset($_GET['id'])) {
    die('Erreur : aucun identifiant de randonnée spécifié');
}

$id = intval($_GET['id']);
$stmt = $bdd->prepare('DELETE FROM hiking WHERE id = ?');
$stmt->execute([$id]);

// Redirection vers read.php
header('Location: read.php');
exit;
