<?php

require_once(__DIR__.'/../../config/bdd_connect.php');
require_once(__DIR__.'/../function/transformPlaceholder.php');
require_once(__DIR__.'/../function/cleanPost.php');
require_once(__DIR__.'/../function/showPost.php');

if (isset($_GET['t'])) {
    switch ($_GET['t']) {
        case "articles":
            $table = "articles_presse";
            $title = "Articles";
            break;
        case "results":
            $table = "resultats_sportifs";
            $title = "Résultat";
            break;
        default:
            die("Mauvais lien de recherche");
    };
} else {
    die("Touche pas l'url, hacker");
}

$postData = cleanPostValue($_POST);

$stringData = trim(strip_tags(implode(", ", array_keys($postData))));
$holderData = trim(strip_tags(implode(", ", array_map('transformPlaceholder', array_keys($postData)))));

echo $stringData."<br>".$holderData."<br>";
var_dump($postData);

$SQLquery =  "INSERT INTO $table($stringData) VALUES ($holderData)";

echo $SQLquery;

$create = $mysqlClient->prepare($SQLquery);

$create->execute($postData);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout dans BDD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include __DIR__.('/../../layout/header.php'); ?>

    <div class="container">

        <h1><?= $title ?> ajouté avec succès ! </h1>

        <?php showPost($postData); ?>
        
    </div>
</body>

</html>