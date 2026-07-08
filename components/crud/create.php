<?php

require_once(__DIR__.'/../button.php');

function create()
{
    $href = null;
    $title = null;

    if (isset($_GET['t'])) {
        switch ($_GET['t']) {
            case "articles":
                $href = "/cdm-blog/public/article.php?t=articles";
                $title = "article";

                return "<div class=\"container\">
    
                <h1 class=\"mb-3\">Ajouter un ".$title."</h1>
                ".buttonBack($href)."    
                <form action=\"../components/crud/create-post.php?t=".$_GET['t']."\" method=\"POST\">
                
                <!-- CHAMP : AUTEUR -->
                <div class=\"mb-3\">
                <label for=\"auteur\" class=\"form-label\">Auteur de l'article</label>
                
                <input type=\"text\" class=\"form-control\" id=\"auteur\" name=\"auteur\">
                </div>

                <!-- CHAMP : ID MATCH -->
                
                <input type=\"hidden\" class=\"form-control\" id=\"match_id\" name=\"match_id\" value=\"0\">
                
                <!-- CHAMP : DATE -->
                
                <input type=\"hidden\" class=\"form-control\" id=\"date_publication\" name=\"date_publication\" value=\"".date('Y-m-d')."\">
                
                
                <!-- CHAMP : TITRE -->
                <div class=\"mb-3\">
                <label for=\"titre\" class=\"form-label\">Titre de l'article</label>
                <input type=\"text\" class=\"form-control\" id=\"titre\" name=\"titre\" aria-describedby=\"titre-help\">
                <div id=\"titre-help\" class=\"form-text\">Choisissez un titre percutant !</div>
                </div>
                
                <!-- CHAMP : CONTENU -->
                <div class=\"mb-3\">
                <label for=\"contenu\" class=\"form-label\">contenu de l'article</label>
                
                <textarea class=\"form-control\" placeholder=\"Seulement du contenu vous appartenant ou libre de droits.\" id=\"contenu\" name=\"contenu\"></textarea>
                </div>
                
                <!-- BOUTONS D'ACTION -->
                <button type=\"submit\" class=\"btn btn-primary\">Envoyer</button>
                <br>
                
                </form>
                </div>";

            case "results":
                $href = "/cdm-blog/public/resultat.php?t=results";
                $title = "résultat";


                return "<div class=\"container\">
    
                <h1 class=\"mb-3\">Ajouter un ".$title."</h1>
                ".buttonBack($href)."    
                <form action=\"../components/crud/create-post.php?t=".$_GET['t']."\" method=\"POST\">
                
                <!-- CHAMP : equipe 1 & 2 -->
                <div class=\"mb-3\">
                <label for=\"equipe1\" class=\"form-label\">Equipe 1</label>
                
                <input type=\"text\" class=\"form-control\" id=\"equipe1\" name=\"equipe1\">
                </div>

                <div class=\"mb-3\">
                <label for=\"equipe2\" class=\"form-label\">Equipe 2</label>
                
                <input type=\"text\" class=\"form-control\" id=\"equipe2\" name=\"equipe2\">
                </div>

                <!-- CHAMP : SCORE -->
                
                <div class=\"mb-3\">
                <label for=\"score\" class=\"form-label\">Score</label>
                
                <input type=\"text\" class=\"form-control\" id=\"score\" name=\"score\">
                </div>.

                <!-- CHAMP : RESUME -->
                
                <div class=\"mb-3\">
                <label for=\"resume\" class=\"form-label\">Resumé</label>
                
                <input type=\"text\" class=\"form-control\" id=\"resume\" name=\"resume\">
                </div>

                <!-- CHAMP : LIEU -->
                
                <div class=\"mb-3\">
                <label for=\"lieu\" class=\"form-label\">Lieu du match</label>
                
                <input type=\"text\" class=\"form-control\" id=\"lieu\" name=\"lieu\">
                </div>
                
                <!-- CHAMP : DATE -->
                
                <div class=\"mb-3\">
                <label for=\"date_match\" class=\"form-label\">Date du match</label>
                
                <input type=\"date\" class=\"form-control\" id=\"date_match\" name=\"date_match\">
                </div>
                

                
                <!-- BOUTONS D'ACTION -->
                <button type=\"submit\" class=\"btn btn-primary\">Envoyer</button>
                <br>
                
                </form>
                </div>";

                break;
            default:
                die("Pas de tables correctement selection dans le switch");
        };
    } else {
        die("Touche pas l'url, hacker");
    }

}
