<?php

require_once(__DIR__.'/../../config/bdd_connect.php');
require_once(__DIR__.'/../button.php');
require_once(__DIR__.'/../function/cleanPost.php');
require_once(__DIR__.'/../function/showPost.php');
require_once(__DIR__.'/../function/validatePost.php');


if (isset($_GET['t'])) {
    switch ($_GET['t']) {
        case "articles":
            $table = "articles_presse";
            $title = "Article";
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

$imageId = $postData['id'];
$path = __DIR__."/../../assets/img/";
$fileName = $imageId . ".webp";
$filePath = $path . $fileName;
$delImg = null;

if (file_exists($filePath) && is_file($filePath)) {
    if (unlink($filePath)) {
        $delImg = "L'image à bien été supprimer du répertoire img";
    } else {
        $delImg = "Erreur lors de la suppression.";
    }
} else {
    $delImg = "Le fichier n'existe pas ou n'est pas un fichier.";
}



$sqlQuery = "DELETE FROM $table WHERE id = :id";

$delete = $mysqlClient->prepare($sqlQuery);
$delete->execute($postData);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression dans la BDD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include __DIR__.('/../../layout/header.php'); ?>

    <div class="container">

        <h1><?= $title ?> supprimé avec succès ! </h1>
        <h2><?= $delImg ?></h2>
        <br>
        <?=  buttonBack('/cdm-blog/public/article.php?t='.$_GET['t']); ?>

    </div>
</body>

</html> 