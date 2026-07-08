<?php 
    $links = [
        "Articles" => "article.php?t=articles",
        "Résultats" => "resultat.php?t=results"
    ];
    $base_href = "/cdm-blog/public/"


?>

<header class=" bg-dark-subtle mb-5">
    <nav class="navbar navbar-expand-lg px-4">
        <div class="container">
            <a class="navbar-brand" href="/cdm-blog/index.php">
            <img src="/cdm-blog/assets/img/coupe-du-monde.png" alt="Icon world cup" width="30" height="30">
             CDM - 2026
            </a>
        </div>
        <ul class=" navbar-nav me-auto">
            <?php foreach($links as $name => $href) : ?>
            
            <li class="nav-item text-decoration-none"><a class="nav-link" href="<?= $base_href.$href ?>"><?= $name ?></a></li>
            <?php endforeach ?>            
        </ul>

    </nav>
</header>