<?php

require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/button.php');
require_once(__DIR__.'/modal.php');
require_once(__DIR__.'/function/truncate.php');

function pageArticle(string $title, string $desc, string $date, string $author, string $id): string
{

    $src = BASE_URL."/assets/img/";
    $path = __DIR__."/../assets/img/";
    $fileName = $id . ".webp";
    $filePath = $path . $fileName;
    $srcPath = $src . $fileName;

    if (file_exists($filePath) && is_file($filePath)) {
        $img = $srcPath;
    } else {
        $img = "https://picsum.photos/500/200";

    }

    return "
    <section class=\"d-flex flex-column\">
        <h1 class=\"text-center\">".$title."</h1>
        <div class=\"d-flex h-100 justify-content-evenly gap-3 m-5\">
            <div class=\"col-6\">
            <img src=\"".$img."\" class=\" card-article-img h-100\" alt=\"Image de l'article ".$id." \">
            </div>

            <div class=\"col-6\">
            <p>".$desc."</p>
            <small>Publié par ".$author."<br>le ".$date."</small><br><br>
            ".buttonBack('/cdm-blog/public/article.php?t=articles')."
            </div>
             
        </div>
    </section>
    ";

}
