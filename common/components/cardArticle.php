<?php

require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/button.php');
require_once(__DIR__.'/modal.php');
require_once(__DIR__.'/function/truncate.php');

function cardArticle(string $title, string $desc, string $date, string $author, string $id): string
{

    $src = BASE_URL."/public/assets/img/";
    $path = __DIR__."/../public/assets/img/";
    $fileName = $id . ".webp";
    $filePath = $path . $fileName;
    $srcPath = $src . $fileName;

    if (file_exists($filePath) && is_file($filePath)) {
        $img = $srcPath;
    } else {
        $img = "https://picsum.photos/500/200";

    }



    return "
    <article class=\"card\" style=\"width: 18rem;\">
        <img src=\"".$img."\" class=\" card-img-top card-article-img\" alt=\"Image de l'article ".$id." \">
        <div class=\"card-body\">
            <small>le ". htmlspecialchars($date)."</small>
            <h5 class=\" card-title\">". htmlspecialchars($title)."</h5>
            <small>par ". htmlspecialchars($author)."</small>
            <p class=\" card-text\">". truncateString(htmlspecialchars($desc))."</p>"
              .
              buttonMore(BASE_URL.'/pages/article.php?t='.$_GET['t'].'&id='.htmlspecialchars($id))
              .
              "<div class=\"d-flex flex-row\">"
              .
                  buttonModif(BASE_URL.'/common/admin/update.php?t='.$_GET['t'].'&id='.htmlspecialchars($id)).
                  buttonModal(htmlspecialchars($id))
              .
              "</div>
        </div>
        <div class=\"card-footer\"></div>
        
        ".modal($_GET['t'], $id, $title)."

    </article>";
}
