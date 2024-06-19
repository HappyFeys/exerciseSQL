<?php
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
$query = $bdd->prepare('SELECT * FROM hiking WHERE id = ?');
$query->execute([$id]);
$hike = $query->fetch();

if (!$hike) {
    die('Erreur : randonnée introuvable');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'], $_POST['height_difference'])) {
    // Mise à jour de la randonnée
    $stmt = $bdd->prepare('UPDATE hiking SET name = ?, difficulty = ?, distance = ?, duration = ?, height_difference = ? WHERE id = ?');
    $stmt->execute([$_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'], $_POST['height_difference'], $id]);
    
    // Rafraîchir les données
    $query->execute([$id]);
    $hike = $query->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="/project/exerciseSQL/rando/read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
