<?php

function showPost(array $post)
{
    echo "Le contenu ajouter comporte : <br>";
    foreach ($post as $key => $value) {
        echo $key." : ".$value."<br>";
    }
}
