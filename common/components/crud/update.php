<?php

require_once(__DIR__.'/../button.php');

function update()
{
    require_once(__DIR__.'/../../config/bdd_connect.php');
    $href = null;
    $title = null;

    if (isset($_GET['t']) && isset($_GET['id'])) {
        switch ($_GET['t']) {
            case "articles":
                $href = BASE_URL."/pages/article.php?t=articles";
                $title = "article";
                $id = $_GET['id'];
                $table = "articles_presse";


                if ($table !== null && $id !== null) {
                    $sqlQuery = '
                SELECT *
                FROM '.$table.'
                WHERE id = '.$id;

                    $newsFraiches = $mysqlClient->prepare($sqlQuery);
                    $newsFraiches->execute();

                    $news = $newsFraiches->fetchAll();


                } else {
                    die("Table ou date null");
                }

                return "<div class=\"container\">
    
                <h1 class=\"mb-3\">Modifier l'".$title." n° ".$id."</h1>
                ".buttonBack($href)."    
                <form action=\"../components/crud/update-post.php?t=".$_GET['t']."&id=".$_GET['id']."\" method=\"POST\" enctype=\"multipart/form-data\">
                
                <!-- CHAMP : AUTEUR -->
                <div class=\"mb-3\">
                <label for=\"auteur\" class=\"form-label\">Auteur de l'article</label>
                
                <input type=\"text\" class=\"form-control\" id=\"auteur\" name=\"auteur\" value=\"".$news[0]['auteur']."\" required>
                </div>

                <!-- CHAMP : ID MATCH -->
                
                <input type=\"hidden\" class=\"form-control\" id=\"match_id\" name=\"match_id\" value=\"0\">
                
                <!-- CHAMP : DATE -->
                
                <input type=\"hidden\" class=\"form-control\" id=\"date_publication\" name=\"date_publication\" value=\"".$news[0]['date_publication']."\">
                
                
                <!-- CHAMP : TITRE -->
                <div class=\"mb-3\">
                <label for=\"titre\" class=\"form-label\">Titre de l'article</label>
                <input type=\"text\" class=\"form-control\" id=\"titre\" name=\"titre\" aria-describedby=\"titre-help\" value=\"".$news[0]['titre']."\" required>
                <div id=\"titre-help\" class=\"form-text\">Choisissez un titre percutant !</div>
                </div>
                
                <!-- CHAMP : CONTENU -->
                <div class=\"mb-3\">
                <label for=\"contenu\" class=\"form-label\">contenu de l'article</label>
                
                <textarea class=\"form-control\" placeholder=\"Seulement du contenu vous appartenant ou libre de droits.\" id=\"contenu\" name=\"contenu\" required>".$news[0]['contenu']."</textarea>
                </div>

                <!-- CHAMP : IMAGE -->
                <div class=\"mb-3\">
                <label for=\"image\" class=\"form-label\">Image de l'article</label>
                <input type=\"file\" class=\"form-control\" id=\"image\" name=\"image\" aria-describedby=\"titre-help\" value=\"".$news[0]['image']."\">
                </div>

                <input type=\"hidden\" class=\"form-control\" id=\"id\" name=\"id\" value=\"".$news[0]['id']."\">
                
                <!-- BOUTONS D'ACTION -->
                <button type=\"submit\" class=\"btn btn-primary\">Envoyer</button>
                <br>
                
                </form>
                </div>";

            case "results":
                $href = BASE_URL."/pages/resultat.php?t=results";
                $title = "résultat";
                $table = "resultats_sportifs";
                $id = $_GET['id'];


                if ($table !== null && $id !== null) {
                    $sqlQuery = '
                SELECT *
                FROM '.$table.'
                WHERE id = '.$id;

                    $newsFraiches = $mysqlClient->prepare($sqlQuery);
                    $newsFraiches->execute();

                    $news = $newsFraiches->fetchAll();


                } else {
                    die("Table ou date null");
                }


                return "<div class=\"container\">
    
                <h1 class=\"mb-3\">Modifier le ".$title." n°".$id."</h1>
                ".buttonBack($href)."    
                <form action=\"../components/crud/update-post.php?t=".$_GET['t']."&id=".$_GET['id']."\" method=\"POST\">
                
                <!-- CHAMP : equipe 1 & 2 -->
                <div class=\"mb-3\">
                <label for=\"equipe1\" class=\"form-label\">Equipe 1</label>
                
                <input type=\"text\" class=\"form-control\" id=\"equipe1\" name=\"equipe1\" value=\"".$news[0]['equipe1']."\" required>
                </div>

                <div class=\"mb-3\">
                <label for=\"equipe2\" class=\"form-label\">Equipe 2</label>
                
                <input type=\"text\" class=\"form-control\" id=\"equipe2\" name=\"equipe2\" value=\"".$news[0]['equipe2']."\" required>
                </div>

                <!-- CHAMP : SCORE -->
                
                <div class=\"mb-3\">
                <label for=\"score\" class=\"form-label\">Score</label>
                
                <input type=\"text\" class=\"form-control\" id=\"score\" name=\"score\" value=\"".$news[0]['score']."\" required>
                </div>.

                <!-- CHAMP : RESUME -->
                
                <div class=\"mb-3\">
                <label for=\"resume\" class=\"form-label\">Resumé</label>
                
                <input type=\"text\" class=\"form-control\" id=\"resume\" name=\"resume\" value=\"".$news[0]['resume']."\" required>
                </div>

                <!-- CHAMP : LIEU -->
                
                <div class=\"mb-3\">
                <label for=\"lieu\" class=\"form-label\">Lieu du match</label>
                
                <input type=\"text\" class=\"form-control\" id=\"lieu\" name=\"lieu\" value=\"".$news[0]['lieu']."\" required>
                </div>
                
                <!-- CHAMP : DATE -->
                
                <div class=\"mb-3\">
                <label for=\"date_match\" class=\"form-label\">Date du match</label>
                
                <input type=\"date\" class=\"form-control\" id=\"date_match\" name=\"date_match\" value=\"".$news[0]['date_match']."\" required>
                </div>
                
                <input type=\"hidden\" class=\"form-control\" id=\"id\" name=\"id\" value=\"".$news[0]['id']."\">
                
                <!-- BOUTONS D'ACTION -->
                <button type=\"submit\" class=\"btn btn-primary\">Envoyer</button>
                <br>
                
                </form>
                </div>";

            default:
                die("Pas de tables correctement selection dans le switch");
        };
    } else {
        die("Touche pas l'url, hacker");
    }

}
