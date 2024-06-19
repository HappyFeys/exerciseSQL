<?php
try {
    // Connexion à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'root', '');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

// Si le formulaire d'ajout est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    // On sécurise les données du formulaire
    $ville = htmlspecialchars($_POST['ville']);
    $haut = htmlspecialchars($_POST['haut']);
    $bas = htmlspecialchars($_POST['bas']);

    // Insertion des données dans la table Météo
    $req = $bdd->prepare('INSERT INTO Météo(ville, haut, bas) VALUES(:ville, :haut, :bas)');
    $req->execute(array(
        'ville' => $ville,
        'haut' => $haut,
        'bas' => $bas
    ));

    // Redirection pour éviter la soumission multiple
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Si une ville doit être supprimée
if (isset($_POST['delete']) && isset($_POST['delete_ville'])) {
    $delete_ville = htmlspecialchars($_POST['delete_ville']);
    $req = $bdd->prepare('DELETE FROM Météo WHERE ville = :ville');
    $req->execute(array('ville' => $delete_ville));

    // Redirection pour éviter la soumission multiple
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Récupération des données de la table Météo
$reponse = $bdd->query('SELECT * FROM Météo');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Météo</title>
</head>
<body>
    <h1>Tableau de la météo</h1>
    <table border="1">
        <tr>
            <th>Ville</th>
            <th>Haut</th>
            <th>Bas</th>
            <th>Action</th>
        </tr>
        <?php while ($donnees = $reponse->fetch()) { ?>
            <tr>
                <td><?php echo $donnees['ville']; ?></td>
                <td><?php echo $donnees['haut']; ?></td>
                <td><?php echo $donnees['bas']; ?></td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="delete_ville" value="<?php echo $donnees['ville']; ?>">
                        <input type="submit" name="delete" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Ajouter une nouvelle ville</h2>
    <form method="post" action="">
        <label for="ville">Ville:</label>
        <input type="text" id="ville" name="ville" required>
        <br>
        <label for="haut">Haut:</label>
        <input type="number" id="haut" name="haut" required>
        <br>
        <label for="bas">Bas:</label>
        <input type="number" id="bas" name="bas" required>
        <br>
        <input type="submit" name="add" value="Ajouter">
    </form>
</body>
</html>
