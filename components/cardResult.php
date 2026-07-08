<?php

require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/button.php');
require_once(__DIR__.'/function/truncate.php');


function cardResultat(string $equipe1, string $equipe2, string $date, string $score, string $resume, string $lieu, string $id): string
{

    return "<article class=\"card\" style=\"width: 18rem;\">
        <div class=\"card-body\">
            <small>le ". htmlspecialchars($date)."</small>
            
            <h5 class=\" card-title text-center\">".htmlspecialchars($equipe1)." vs ".htmlspecialchars($equipe2)."
            <br>
            ".htmlspecialchars($score)."
            </h5>
            <small>à ". htmlspecialchars($lieu)."</small>
            <p class=\" card-text\">". truncateString(htmlspecialchars($resume))."</p>"
              .
              buttonMore(BASE_URL.'/read.php?id='.htmlspecialchars($id))
              .
              "<div class=\"d-flex flex-row\">"
              .
                  buttonModif(BASE_URL.'/admin/update.php?t='.$_GET['t'].'&id='.htmlspecialchars($id)).
                  buttonModal(htmlspecialchars($id))
              .
              "</div>
        </div>
        <div class=\"card-footer\"></div>

        ".modal($_GET['t'], $id, (htmlspecialchars($equipe1)." vs ".htmlspecialchars($equipe2)))."
    </article>";
}
