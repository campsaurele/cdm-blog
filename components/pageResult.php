<?php

require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/button.php');
require_once(__DIR__.'/modal.php');
require_once(__DIR__.'/function/truncate.php');

function pageResult(string $equipe1, string $equipe2, string $date, string $score, string $resume, string $lieu, string $id): string
{


    return "
    <section class=\"d-flex flex-column\">
        <h1 class=\"text-center\">".$equipe1." VS ".$equipe2."</h1>
        <div class=\"d-flex h-100 justify-content-center align-items-center gap-3 m-5\">
            <div class=\"col-6\">
            <h2 class=\"text-center\">Score <br>".$score."</h2>
            </div>

            <div class=\"col-6\">
            <p>".$resume."</p>
            <small>Match du  ".$date."<br> à ".$lieu."</small><br><br>
            ".buttonBack('/cdm-blog/public/article.php?t=articles')."
            </div>
             
        </div>
    </section>
    ";

}
