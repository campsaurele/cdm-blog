<?php

function truncateString(string $string, int $length = 25)
{
    // strlen() : compte le nombre de caractères
    if (strlen($string) > $length) {
        // substr() : extrait une partie de la chaîne (de 0 à $length)
        return substr($string, 0, $length) . ' (...)';
    }
    // Si le texte est assez court, on le retourne tel quel
    return $string;
}
