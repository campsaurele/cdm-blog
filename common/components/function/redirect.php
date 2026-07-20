<?php

function redirectToUrl(string $url): never
{
    // Envoi d'un header HTTP pour rediriger le navigateur
    header("Location: {$url}");
    // Arrêt du script pour éviter d'exécuter du code après la redirection
    exit();
}
