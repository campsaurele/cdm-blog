<?php

// Button Components here, 3 for Modify, Delete and Back.

function buttonModif(string $href): string
{
    $href = htmlspecialchars($href);
    return "<a class=\"btn btn-primary mb-2 me-2\" href=\"$href\">Modifier</a>";
}

function buttonSuppr(string $href): string
{
    $href = htmlspecialchars($href);
    return "<a class=\"btn btn-danger mb-2\" href=\"$href\">Supprimer</a>";
}

function buttonBack(string $href): string
{
    $href = htmlspecialchars($href);
    return "<a class=\"btn btn-info mb-2\" href=\"$href\">Retour</a>";
}

function buttonMore(string $href): string
{
    $href = htmlspecialchars($href);
    return "<a class=\"btn btn-info mb-2\" href=\"$href\">En voir plus</a>";
}

function buttonAdd(string $href): string
{
    $href = htmlspecialchars($href);
    return "<a class=\"btn btn-primary mb-4 ms-3\" href=\"$href\">Ajouter</a>";
}



?>




