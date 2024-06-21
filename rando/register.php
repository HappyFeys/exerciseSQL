<?php
session_start();
include 'auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=rando;charset=utf8', 'root', '');
        
        $username = $_POST['username'];
        $password = sha1($_POST['password']);

        $stmt = $bdd->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->execute([$username, $password]);

        echo "Utilisateur ajouté avec succès.";
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <form method="post" action="register.php">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
