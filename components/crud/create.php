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
                break;
            case "results":
                $href = "/cdm-blog/public/resultat.php?t=results";
                $title = "résultat";
                break;
            default:
                echo "Pas de tables correctement selectionn dans le switch";
        };
    } else {
        die("Touche pas l'url, hacker");
    }



    return "<div class=\"container\">
    
    <h1 class=\"mb-3\">Ajouter un ".$title."</h1>
    ".buttonBack($href)."    
    <form action=\"../components/crud/create-post.php?t=".$_GET['t']."\" method=\"POST\">
    
    <!-- CHAMP : AUTEUR -->
    <div class=\"mb-3\">
    <label for=\"auteur\" class=\"form-label\">Auteur de l'article</label>
    
    <input type=\"text\" class=\"form-control\" id=\"auteur\" name=\"auteur\">
    </div>
    
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
}
