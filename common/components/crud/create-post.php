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
        case "user":
            $table = "user";
            $title = "Utilisateur";
            $required = ["login", "password"];
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
    echo buttonBack(BASE_URL.'/common/admin/add.php?t='.$_GET['t']);
    return;
}



$stringData = trim(strip_tags(implode(", ", array_keys($postData))));
$holderData = trim(strip_tags(implode(", ", array_map('transformPlaceholder', array_keys($postData)))));


$SQLquery =  "INSERT INTO $table($stringData) VALUES ($holderData)";


$create = $mysqlClient->prepare($SQLquery);

$create->execute($postData);

$imageId = $mysqlClient->lastInsertId();
// ============================================================
// TRAITEMENT DE L'UPLOAD D'IMAGE
// ============================================================
// $_FILES est un tableau contenant les informations sur les fichiers uploadés

// Vérification qu'une image a été uploadée et qu'il n'y a pas d'erreur
// $_FILES['image']['error'] == 0 signifie : pas d'erreur lors de l'upload
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    // Vérification du type MIME du fichier (sécurité)
    // mime_content_type() détecte le vrai type du fichier (pas juste l'extension)
    $typeMime = mime_content_type($_FILES['image']['tmp_name']);

    // On accepte uniquement les images webp
    if ($typeMime === "image/webp") {

        // Déplacement du fichier temporaire vers le dossier img/
        // avec renommage selon l'ID de l'article
        $dossier = __DIR__."/../../public/assets/img/";
        $nomFichier = $imageId . ".webp";

        // move_uploaded_file() déplace le fichier du dossier temporaire vers sa destination finale
        // $_FILES['image']['tmp_name'] = chemin temporaire du fichier uploadé
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $nomFichier)) {
            echo "Image enregistrée avec succès.";
        } else {
            echo "Erreur lors de l'enregistrement de l'image.";
        }


    } else {
        echo "Erreur : seul le format webp est accepté.";
    }
}


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