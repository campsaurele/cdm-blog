<?php

include(__DIR__. '/../../config/bdd_connect.php');
require_once(__DIR__. '/../cardArticle.php');
require_once(__DIR__. '/../cardResult.php');

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

if ($table !== null && $date !== null) {
    $sqlQuery = '
        SELECT *
        FROM '.$table.'
        ORDER BY date_'.$date.'
        DESC;';

    $newsFraiches = $mysqlClient->prepare($sqlQuery);
    $newsFraiches->execute();

    $news = $newsFraiches->fetchAll();
} else {
    die("Table ou date null");
}

echo "<section class=\"d-flex flex-column\">";
echo "<h1 class=\"text-center\">".$title."</h1>";
echo buttonAdd("/cdm-blog/admin/add.php?t=".$_GET['t']);
echo "<div class=\"d-flex flex-wrap justify-content-evenly gap-3\">";

foreach ($news as $new) {

    switch ($table) {
        case "resultats_sportifs":
            echo cardResultat($new['equipe1'], $new['equipe2'], $new['date_match'], $new['score'], $new['resume'], $new['lieu'], $new['id']);
            break;

        case "articles_presse":
            echo cardArticle($new['titre'], $new['contenu'], $new['date_publication'], $new['auteur'], $new['id']);
            break;

        default:
            echo "Kessispass encore";
    }

}
echo "</div>";
echo "</section>";

?>

