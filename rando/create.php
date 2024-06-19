<?php
try {
    // Connexion à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=rando;charset=utf8', 'root', '');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['button'])) {
    // On sécurise les données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $difficulty = htmlspecialchars($_POST['difficulty']);
    $distance = htmlspecialchars($_POST['distance']);
	$duration = htmlspecialchars($_POST['duration']);
	$heigtdiff = htmlspecialchars($_POST['height_difference']);

    // Insertion des données dans la table Météo
    $req = $bdd->prepare('INSERT INTO hiking(name, difficulty, distance, duration, height_difference) VALUES(:name, :difficulty, :distance, :duration, :heigtdiff)');
    $req->execute(array(
        'name' => $name,
        'difficulty' => $difficulty,
        'distance' => $distance,
		'duration' => $duration,
		'heigtdiff'=> $heigtdiff
    ));

    // Redirection pour éviter la soumission multiple
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
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
