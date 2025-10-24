<?php
include "Session.php";
//données nécessaires à la connection à ma bdd
$user = "root";
$pass = "";
$dbname = "postetasession";
$host = "localhost";

//connection à la bdd avecc pdo
$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$requeteModification=$db->prepare("select * from session where id = ?");
$sessionId = $_GET['sessionId'];
$requeteModification->bindParam(1, $sessionId);
$requeteModification->execute();
$requeteModification->setFetchMode(PDO::FETCH_CLASS, "Session");
$resultat = $requeteModification->fetchAll();
$session = $resultat[0];



//requete de modification
if (isset($_GET['poisson']) && isset($_GET['poids']) && isset($_GET['spot']) && isset($_GET['date'])){
    $poisson = $_GET['poisson'];
    $poids = $_GET['poids'];
    $spot = $_GET['spot'];
    $date = $_GET['date'];
    $sessionId = $_GET['sessionId'];

    $requeteSession = $db->prepare("update session set prise = ?,poids = ?,spot = ?,date = ? where id = ?");
    $requeteSession->bindParam(1, $poisson);
    $requeteSession->bindParam(2, $poids);
    $requeteSession->bindParam(3, $spot);
    $requeteSession->bindParam(4, $date);
    $requeteSession->bindParam(5, $sessionId);
    $requeteSession->execute();
    header("Location: index.php");

}

    ?>
<!doctype html >
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title> Modifier</title>
</head>
<body>
<div class="container w-100 min-vh-100 d-flex flex-column justify-content-center align-items-center">
<!--formulaire d'ajout d'une session-->
<form class="bg-primary-subtle p-3 rounded-2 m-5" method="get" action="update.php">
    <div class="display-1 m-1 mb-3">Modifie ta session</div>
    <div class="d-flex flex-column">
        <input class="form-control mb-2" type="text" name="poisson" placeholder="Prises" id="poisson" value="<?php echo $session->getPrise() ?>">
        <input class="form-control mb-2" type="text" name="poids" placeholder="Poids total" id="poids" value="<?php echo $session->getPoids() ?>">
        <input class="form-control mb-2" type="text" name="spot" placeholder="Spot de pêche" id="spot" value="<?php echo $session->getSpot() ?>">
        <input class="form-control mb-2" type="date" name="date" placeholder="Date" id="date" value="<?php echo $session->getDate() ?>">
    </div>
    <input class="btn btn-outline-primary mb-2" type="submit" value="Modifier">
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    </div>
</body>
</html>