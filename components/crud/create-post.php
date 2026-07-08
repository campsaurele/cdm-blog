<?php

require_once(__DIR__.'/../../config/bdd_connect.php');
require_once(__DIR__.'/../function/transformPlaceholder.php');
require_once(__DIR__.'/../function/cleanPost.php');
require_once(__DIR__.'/../function/showPost.php');
require_once(__DIR__.'/../button.php');
require_once(__DIR__.'/../function/validatePost.php');



if (isset($_GET['t'])) {
    switch ($_GET['t']) {
        case "articles":
            $table = "articles_presse";
            $title = "Articles";
            $required = ["titre","auteur","contenu","date_publication","match_id"];
            break;
        case "results":
            $table = "resultats_sportifs";
            $title = "Résultat";
            $required = ["equipe1","equipe2","score","resume","lieu","date_match",];
            break;
        default:
            die("Mauvais lien de recherche");
    };
} else {
    die("Touche pas l'url, hacker");
}

$postData = cleanPostValue($_POST);

$validate = validatePost($postData, $required);

if (!$validate) {
    echo "Les champs ne sont pas remplis <br>";
    echo buttonBack('/cdm-blog/admin/add.php?t='.$_GET['t']);
    return;
}



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
        <br>
        <?=  buttonBack('/cdm-blog/public/article.php?t='.$_GET['t']); ?>

    </div>
</body>

</html>