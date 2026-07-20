<?php

try { // tentative d'accès
    
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=sport_2000;charset=utf8',  // emplacement bdd
        'root',                                                  // login
        ''                                                        // mdp
    );

    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Erreur

} catch (Exception $e) {                                                   // Catch de l'erreur

    die('Erreur de connexion à la base de données : ' . $e->getMessage()); // stop le script et affiche l'erreur

    }

?>