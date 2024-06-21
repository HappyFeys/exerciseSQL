<?php
try {
    // Connexion à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

$reponseClient = $bdd->query('SELECT * FROM clients');
$responseSpectacle = $bdd->query('SELECT * FROM showtypes');
$reponseClientfirst = $bdd->query('SELECT lastName, firstName FROM clients LIMIT 20');
$reponseClientCard = $bdd->query('SELECT lastName, firstName FROM clients WHERE card = 1');
$reponseClientM = $bdd->query('SELECT lastName, firstName FROM clients WHERE lastName LIKE \'M%\' ORDER BY lastName');
$reponseShows = $bdd->query('SELECT title, performer, date FROM shows ORDER BY title');
$reponseClientDetails = $bdd->query('SELECT lastName, firstName, birthDate, card, cardNumber FROM clients');


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Colyseum</title>
</head>
<body>
    <h1>Tableau à propos du colyseum</h1>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            
        </tr>
        <?php while ($donnees = $reponseClient->fetch()) { ?>
            <tr>
                <td><?php echo $donnees['lastName']; ?></td>
                <td><?php echo $donnees['firstName']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            
        </tr>
        <?php while ($donnees = $reponseClientfirst->fetch()) { ?>
            <tr>
                <td><?php echo $donnees['lastName']; ?></td>
                <td><?php echo $donnees['firstName']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            
        </tr>
        <?php while ($donnees = $reponseClientCard->fetch()) { ?>
            <tr>
                <td><?php echo $donnees['lastName']; ?></td>
                <td><?php echo $donnees['firstName']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            
        </tr>
        <?php while ($donnees = $reponseClientM->fetch()) { ?>
            <tr>
                <td><?php echo $donnees['lastName']; ?></td>
                <td><?php echo $donnees['firstName']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <table border="1">
        <tr>
            <th>Type de spectacle</th>
            
        </tr>
        <?php while ($donnees = $responseSpectacle->fetch()) { ?>
            <tr>
                <td><?php echo $donnees['type']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <table border="1">
        <tr>
            <th>Titre</th>
            <th>Performer</th>
            <th>Date</th>
        </tr>
        <?php while ($donnees = $reponseShows->fetch()) { ?>
            <tr>
                <td><?php echo $donnees['title']; ?></td>
                <td><?php echo $donnees['performer']; ?></td>
                <td><?php echo $donnees['date']; ?></td>
            </tr>
        <?php } ?>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Carte</th>
            <th>Numéro de carte</th>
        </tr>
        <?php while ($donnees = $reponseClientDetails->fetch()) { ?>
            <tr>
                <td><?php echo $donnees['lastName']; ?></td>
                <td><?php echo $donnees['firstName']; ?></td>
                <td><?php echo $donnees['birthDate']; ?></td>
                <td><?php echo $donnees['card']; ?></td>
                <td><?php echo $donnees['cardNumber']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>