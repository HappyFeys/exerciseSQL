<?php
try {
    // Connexion à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=rando;charset=utf8', 'root', '');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM hiking');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <a href="/project/exerciseSQL/rando/create.php">Ajouter des données</a>
    <h1>Liste des randonnées</h1>
    <table border="1">
      <!-- Afficher la liste des randonnées -->
      <tr>
          <th>Nom</th>
          <th>Difficulté</th>
          <th>Distance</th>
          <th>Durée</th>
          <th>Dénivelé positif</th>
          <th>Action</th>
      </tr>
      <?php while ($donnees = $reponse->fetch()) { ?>
          <tr>
              <td><a href="update.php?id=<?php echo $donnees['id']; ?>"><?php echo $donnees['name']; ?></a></td>
              <td><?php echo $donnees['difficulty']; ?></td>
              <td><?php echo $donnees['distance']; ?>km</td>
              <td><?php echo $donnees['duration']; ?>heures</td>
              <td><?php echo $donnees['height_difference']; ?>m</td>
              <td>
                <a href="update.php?id=<?php echo $donnees['id']; ?>">Modifier</a>
                <a href="delete.php?id=<?php echo $donnees['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette randonnée ?');">Supprimer</a>
              </td>
          </tr>
      <?php } ?>
    </table>
  </body>
</html>
