<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=rando;charset=utf8', 'root', '');
        
        $username = $_POST['username'];
        $password = sha1($_POST['password']);

        $stmt = $bdd->prepare('SELECT id, username FROM users WHERE username = ? AND password = ?');
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: read.php');
            exit();
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <form method="post" action="login.php">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
