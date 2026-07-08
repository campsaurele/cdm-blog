<?php

require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/button.php');
require_once(__DIR__.'/function/truncate.php');

function cardArticle(string $title, string $desc, string $date, string $author, string $id): string
{

    return "
    <article class=\"card\" style=\"width: 18rem;\">
        <img src=\"...\" class=\" card-img-top\" alt=\"Image de la card \">
        <div class=\"card-body\">
            <small>le ". htmlspecialchars($date)."</small>
            <h5 class=\" card-title\">". htmlspecialchars($title)."</h5>
            <small>par ". htmlspecialchars($author)."</small>
            <p class=\" card-text\">". truncateString(htmlspecialchars($desc))."</p>"
              .
              buttonMore(BASE_URL.'/read.php?id='.htmlspecialchars($id))
              .
              "<div class=\"d-flex flex-row\">"
              .
                  buttonModif(BASE_URL.'/admin/update.php?t='.$_GET['t'].'&id='.htmlspecialchars($id)).
                  buttonSuppr(BASE_URL.'/admin/delete.php?t='.$_GET['t'].'&id='.htmlspecialchars($id))
              .
              "</div>
        </div>
        <div class=\"card-footer\"></div>
    </article>";
}
