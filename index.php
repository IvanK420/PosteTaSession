<?php
//inclut les fichiers nécessaires à l'utilisation de mes classes
include "Pecheur.php";
include "Session.php";
//données nécessaires à la connection à ma bdd
$user = "root";
$pass = "";
$dbname = "postetasession";
$host = "localhost";

//connection à la bdd avecc pdo
$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
//var_dump($db);
$requetePecheur = "";
$requeteSession = "";
$pecheur = "";
if (isset($_GET['pseudo'])) {
    $requetePecheur = $db->prepare("select * from pecheur
         where pseudo = ? and secteur = ? ");
    $pseudo = $_GET['pseudo'];
    $technique = $_GET['technique'];
    $secteur = $_GET['secteur'];
    $requetePecheur->bindParam(1, $pseudo);
    $requetePecheur->bindParam(2, $secteur);
    $requetePecheur->execute();
    $requetePecheur->setFetchMode(PDO::FETCH_CLASS, "Pecheur");
    $resultat = $requetePecheur->fetchAll();

//  vérification de l'existence du pecheur dans la bdd

    if (empty($resultat)) {
        $pecheur = new Pecheur();
        $pecheur->setPseudo($pseudo);
        $pecheur->setSecteur($secteur);
        $pecheur->setTechnique($technique);
        $requeteCreationPecheur = $db->prepare("insert into pecheur(pseudo,technique,secteur) values(?,?,?)");
        $requeteCreationPecheur->bindParam(1, $pseudo);
        $requeteCreationPecheur->bindParam(2, $technique);
        $requeteCreationPecheur->bindParam(3, $secteur);
        $requeteCreationPecheur->execute();
    } else {
        $pecheur = $resultat[0];
    }
//    recupération de l'id du pecheur dans la bdd
    $requeteID = $db->prepare("select Id from pecheur where pseudo = ? and secteur = ?");
    $requeteID->bindParam(1, $pseudo);
    $requeteID->bindParam(2, $secteur);
    $requeteID->execute();
    $requeteID->setFetchMode(PDO::FETCH_OBJ);
    $resultatID = $requeteID->fetchAll();
    $idPecheur = $resultatID[0]->Id;

//  création d'une session dans la bdd
    $requeteSession = $db->prepare("insert into session(Idpecheur,prise,poids,date,spot) values(?,?,?,?,?)");
    $prise = $_GET['poisson'];
    $poids = $_GET['poids'];
    $date = $_GET['date'];
    $spot = $_GET['spot'];
    $requeteSession->bindParam(1, $idPecheur);
    $requeteSession->bindParam(2, $prise);
    $requeteSession->bindParam(3, $poids);
    $requeteSession->bindParam(4, $date);
    $requeteSession->bindParam(5, $spot);
    $requeteSession->execute();
    $requeteSession->setFetchMode(PDO::FETCH_OBJ);
    $resultat = $requeteSession->fetchAll();

}

if (isset($_GET['sessionId'])) {
    $requeteSession = $db->prepare("delete from session where id = ?");
    $sessionId = $_GET['sessionId'];
    $requeteSession->bindParam(1, $sessionId);
    $requeteSession->execute();
    $requeteSession->setFetchMode(PDO::FETCH_OBJ);
    $resultat = $requeteSession->fetchAll();
    header("Location: index.php");
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Poste ta session</title>
</head>
<body>
<div class="container w-100 min-vh-100 d-flex flex-column justify-content-center align-items-center">


    <!--formulaire d'ajout d'une session-->
    <form class="bg-primary-subtle p-3 rounded-2 m-5" method="get" action="index.php">
        <div class="display-1 m-1 mb-3">Poste ta session</div>
        <div class="d-flex flex-column">
            <input class="form-control mb-2 " type="text" name="pseudo" placeholder="Pseudo" id="pseudo">
            <input class="form-control mb-2 " type="text" name="technique" placeholder="Technique préférée"
                   id="technique">
            <input class="form-control mb-2 " type="text" name="secteur" placeholder="Secteur" id="secteur">
        </div>
        <div class="d-flex flex-column">
            <input class="form-control mb-2" type="text" name="poisson" placeholder="Prises" id="poisson">
            <input class="form-control mb-2" type="text" name="poids" placeholder="Poids total" id="poids">
            <input class="form-control mb-2" type="text" name="spot" placeholder="Spot de pêche" id="spot">
            <input class="form-control mb-2" type="date" name="date" placeholder="Date" id="date">
        </div>
        <input class="btn btn-outline-primary mb-2" type="submit" value="Ajouter">
    </form>

    <!--tableau des session-->
    <table class="table table-bordered table-striped table-hover">
        <thead>

        <tr>
            <th>Pseudo</th>
            <th>Technique</th>
            <th>secteur</th>
            <th>Prises</th>
            <th>Poids</th>
            <th>Spot</th>
            <th>Date</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $requeteTableau = $db->query("select pecheur.Id as pecheur_id,
            pecheur.pseudo, 
            pecheur.technique, 
            pecheur.secteur,
            session.id as session_id,
            session.prise, 
            session.poids, 
            session.spot, 
            session.date
        from pecheur inner join session on pecheur.Id = session.Idpecheur");
        $requeteTableau->setFetchMode(PDO::FETCH_ASSOC);
        $resultats = $requeteTableau->fetchAll();
//        var_dump($resultats);
        foreach ($resultats as $resultat) {
            echo "<tr>
    <td>" . $resultat['pseudo'] . "</td> 
    <td>" . $resultat['technique'] . "</td> 
    <td>" . $resultat['secteur'] . "</td> 
    <td>" . $resultat['prise'] . "</td> 
    <td>" . $resultat['poids'] . "</td> 
    <td>" . $resultat['spot'] . "</td> 
    <td>" . $resultat['date'] . "</td>
    <td>
        <form method='get' action='update.php'>
            <input type='hidden' name='sessionId' value='" . $resultat['session_id'] . "'>
            <input class='btn btn-warning' type='submit' value='Modifier'>
        </form>
    </td>
    <td>
        <form method='get' action='index.php'>
            <input type='hidden' name='sessionId' value='" . $resultat['session_id'] . "'>
            <input class='btn btn-danger' type='submit' value='Supprimer'>
        </form>
    </td>
</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>
