<?php

include(__DIR__. '/../../config/bdd_connect.php');
require_once(__DIR__. '/../cardArticle.php');
require_once(__DIR__. '/../pageArticle.php');
require_once(__DIR__. '/../cardResult.php');
require_once(__DIR__. '/../pageResult.php');
require_once(__DIR__. '/../function/cleanPost.php');

/*
 function transformVar(string $string)
    {
        return ":".$string;
    }

    // Si tout va bien, on peut continuer
    $postData = ['titre' => 'A', 'contenu' => 'B', 'auteur' => 'C'];

    var_dump(array_keys($postData));
    $stringData = implode(", ", array_keys($postData));
    $varData = implode(", ",array_map('transformVar', array_keys($postData)));
    var_dump($varData);
    $table = "articles_presse";


$query = "INSERT INTO $table($stringData) VALUES ($varData)";
echo $query;
*/
$table = null;
$date = null;
$title = null;

if (isset($_GET['t'])) {
    switch ($_GET['t']) {
        case "articles":
            $table = "articles_presse";
            $date = "publication";
            $title = "Articles";
            break;
        case "results":
            $table = "resultats_sportifs";
            $date = "match";
            $title = "Résultats";
            break;
        default:
            die("Mauvais lien");
    };
} else {
    die("Touche pas l'url, hacker");
}

// cardResultat(string $equipe1, string $equipe2, string $date, string $score, string $resume, string $lieu, string $id)
// cardArticle(string $title, string $desc, string $date, string $author, string $id)

if (!isset($_GET['id'])) {
    $sqlQuery = '
    SELECT *
        FROM '.$table.'
        ORDER BY date_'.$date.'
        DESC;';

    $newsFraiches = $mysqlClient->prepare($sqlQuery);
    $newsFraiches->execute();

    $news = $newsFraiches->fetchAll();

    echo "<section class=\"d-flex flex-column\">";
    echo "<h1 class=\"text-center\">".$title."</h1>";
    echo buttonAdd(BASE_URL."/common/admin/add.php?t=".$_GET['t']);
    echo "<div class=\"d-flex flex-wrap justify-content-evenly gap-3\">";

    foreach ($news as $new) {

        switch ($table) {
            case "resultats_sportifs":
                echo cardResultat($new['equipe1'], $new['equipe2'], $new['date_match'], $new['score'], $new['resume'], $new['lieu'], $new['id']);
                break;

            case "articles_presse":
                echo cardArticle($new['titre'], $new['contenu'], $new['date_publication'], $new['auteur'], $new['id']);
                break;
        }

    }
    echo "</div>";
    echo "</section>";

} elseif (isset($_GET['id'])) {

    $getData = cleanPostValue($_GET);


    $sqlQuery = "
        SELECT *
            FROM $table
            WHERE id = :id";


    $newsFraiches = $mysqlClient->prepare($sqlQuery);


    $newsFraiches->bindValue(':id', $getData['id']);

    $newsFraiches->execute();


    $news = $newsFraiches->fetch();






    switch ($table) {
        case "resultats_sportifs":
            echo pageResult($news['equipe1'], $news['equipe2'], $news['date_match'], $news['score'], $news['resume'], $news['lieu'], $news['id']);
            break;

        case "articles_presse":
            echo pageArticle($news['titre'], $news['contenu'], $news['date_publication'], $news['auteur'], $news['id']);
            break;
    }


} else {
    echo "l'id n'existe pas";
}
?>

