<?php
$links = [
    "Articles" => "/cdm-blog/pages/article.php?t=articles",
    "Résultats" => "/cdm-blog/pages/resultat.php?t=results"
];
//    $base_href = "/cdm-blog/public/"


?>

<header class=" bg-dark-subtle mb-5">
    <nav class="navbar navbar-expand-lg px-4">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL."/public/index.php" ?>">
            <img src="/cdm-blog/public/assets/img/coupe-du-monde.png" alt="Icon world cup" width="30" height="30">
             CDM - 2026
            </a>
        </div>
        <ul class=" navbar-nav me-auto">
            <?php foreach ($links as $name => $href) : ?>
            
            <li class="nav-item text-decoration-none"><a class="nav-link" href="<?= $href ?>"><?= $name ?></a></li>
            <?php endforeach ?>            
        </ul>

    </nav>
</header>