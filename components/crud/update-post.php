<?php

require_once(__DIR__.'/../../config/bdd_connect.php');
require_once(__DIR__.'/../function/transformPlaceholder.php');
require_once(__DIR__.'/../function/transformSetdata.php');
require_once(__DIR__.'/../function/cleanPost.php');
require_once(__DIR__.'/../function/showPost.php');
require_once(__DIR__.'/../button.php');
require_once(__DIR__.'/../function/validatePost.php');



if (isset($_GET['t']) && isset($_GET['id'])) {
    switch ($_GET['t']) {
        case "articles":
            $table = "articles_presse";
            $title = "Articles";
            $required = ["titre","auteur","contenu","date_publication","match_id"];
            $id = $_GET['id'];
            break;
        case "results":
            $table = "resultats_sportifs";
            $title = "Résultat";
            $required = ["equipe1","equipe2","score","resume","lieu","date_match",];
            $id = $_GET['id'];
            break;
        default:
            die("Mauvais lien de recherche");
    };
} else {
    die("Touche pas l'url, hacker");
}

$postData = cleanPostValue($_POST);
$updateData = $postData; // copy postData for futur use
$validate = validatePost($postData, $required);

$imageId = $postData['id'];

if (!$validate) {
    echo "Les champs ne sont pas remplis <br>";
    echo buttonBack('/cdm-blog/admin/add.php?t='.$_GET['t']);
    return;
}

$loadImg = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    // Vérification du type MIME du fichier (sécurité)
    // mime_content_type() détecte le vrai type du fichier (pas juste l'extension)
    $typeMime = mime_content_type($_FILES['image']['tmp_name']);

    // On accepte uniquement les images webp
    if ($typeMime === "image/webp") {

        // Déplacement du fichier temporaire vers le dossier img/
        // avec renommage selon l'ID de l'article
        $dossier = __DIR__."/../../assets/img/";
        $nomFichier = $imageId . ".webp";

        // move_uploaded_file() déplace le fichier du dossier temporaire vers sa destination finale
        // $_FILES['image']['tmp_name'] = chemin temporaire du fichier uploadé
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $nomFichier)) {
            $loadImg = "Image enregistrée avec succès.";
        } else {
            $loadImg = "Erreur lors de l'enregistrement de l'image.";
        }


    } else {
        echo "Erreur : seul le format webp est accepté.";
    }
}



unset($updateData['id']); // removing id here before creating setData

$setData = implode(", ", array_map('transformSetdata', array_keys($updateData), array_map('transformPlaceholder', array_keys($updateData))));
$setId = "id = :id";
// objectif : $setData = "$string = $holder, $string = $holder, $string = $holder etc..."

$SQLquery =  "UPDATE $table SET $setData WHERE $setId";

$update = $mysqlClient->prepare($SQLquery);

$update->execute($postData);

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

        <h1><?= $title ?> modifié avec succès ! </h1>

        <?php showPost($updateData); ?>
        <?= '<p>'.$loadImg.'<p>' ?>
        <br>
        <?=  buttonBack('/cdm-blog/public/article.php?t='.$_GET['t']); ?>

    </div>
</body>

</html> 
