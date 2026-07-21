<?php

/*
 * Traitement du formulaire de connexion - submit-login.php
 * =========================================================
 *
 * Ce fichier traite les données soumises par le formulaire de connexion.
 * Il vérifie les identifiants et connecte l'utilisateur si tout est correct.
 *
 * ⚠️ IMPORTANT : Ce fichier ne contient PAS de HTML, c'est un fichier de traitement pur.
 * Après traitement, il redirige toujours vers index.php.
 *
 * 📚 Concepts abordés :
 * - Traitement de formulaire POST
 * - Validation des données
 * - Authentification avec mot de passe hashé (password_hash / password_verify)
 * - Stockage d'informations en session
 * - Redirection après traitement
 *
 * ⚠️ SÉCURITÉ : Pour aller plus loin en production, il faudrait aussi :
 * - Limiter les tentatives de connexion
 * - Protéger contre les attaques par force brute
 */

// Démarrage de la session pour stocker les informations de connexion
session_start();


require(__DIR__ . '/../config/bdd_connect.php');
require(__DIR__ . '/../config/config.php');

include(__DIR__ . '/function/redirect.php');
include(__DIR__ . '/function/transformPlaceholder.php');


$postData = $_POST;
$table = 'user';

$action = $postData['action'];

if(isset($postData['action']))
    {
        unset($postData['action']);
        switch($action)
        {
            case 'connect':

                $sqlQueryLogin = "SELECT login, password FROM $table";
                $userbddlogin = $mysqlClient->prepare($sqlQueryLogin);
                $userbddlogin->execute();

                $user = $userbddlogin->fetch();

                if (isset($postData['login']) && isset($postData['password'])) {

                // ÉTAPE 1 : Validation du format de l'email
                if (!filter_var($postData['login'], FILTER_VALIDATE_EMAIL)) {
                    // L'email n'est pas valide, on stocke un message d'erreur en session
                    $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Identifiants/Mdp incorrect';

                } else {
                    // ÉTAPE 2 : Recherche de l'utilisateur dans la base de données

                    $sqlQueryUser = 'SELECT * FROM `users`';
                    $userbdd = $mysqlClient->prepare($sqlQueryUser);
                    $userbdd->execute();
                    // $abonnes contient un tableau avec tous les abonnés
                    $users = $userbdd->fetchAll();

                    /*
                    * $abonnes vient de functions.php et contient tous les utilisateurs
                    * On parcourt le tableau pour trouver une correspondance
                    */
                    foreach ($users as $user) {
                        /*
                        * Vérification des identifiants
                        *
                        * password_verify() compare le mot de passe en clair saisi par
                        * l'utilisateur avec le hash stocké en base (généré par password_hash())
                        */
                        if (
                            $user['login'] === $postData['login'] &&
                            password_verify($postData['password'], $user['password'])
                        ) {
                            /*
                            * ✅ AUTHENTIFICATION RÉUSSIE
                            *
                            * On stocke les informations de l'utilisateur en session
                            * Attention : On ne stocke JAMAIS le mot de passe en session !
                            */
                            $_SESSION['LOGGED_USER'] = [
                                'login' => $user['login'],
                                'role' => $user['role'],
                            ];
                        }
                    }


                    // ÉTAPE 3 : Vérification du résultat de l'authentification
                    if (!isset($_SESSION['LOGGED_USER'])) {
                        /*
                        * ❌ ÉCHEC DE L'AUTHENTIFICATION
                        *
                        * Aucun utilisateur ne correspond aux identifiants fournis
                        * On crée un message d'erreur
                        *
                        * sprintf() permet de formater une chaîne avec des variables
                        * strip_tags() retire les balises HTML pour éviter les injections XSS
                        */
                        $_SESSION['LOGIN_ERROR_MESSAGE'] = sprintf(
                            'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                            $postData['login'],
                            strip_tags($postData['password'])
                        );
                    }
                }
            }

            break;


            // CREATION COMPTE ICI

            case 'create':           
            $sqlQueryLogin = "SELECT login FROM $table WHERE login = :login";
            $userbddlogin = $mysqlClient->prepare($sqlQueryLogin);
            $userbddlogin->execute([
                'login' => $postData['login']
            ]);

            $user = $userbddlogin->fetch();

            if($user['login'] == $postData['login'])
                {
                    $_SESSION['CREATE_MESSAGE'] = "Cet identifiant ne peut pas être utilisé.";

                    break;
                }
    
                
            $postData['role'] = 'visitor';
            
            $stringData = trim(strip_tags(implode(", ", array_keys($postData))));

            $holderData = trim(strip_tags(implode(", ", array_map('transformPlaceholder', array_keys($postData)))));
            
            $SQLquery =  "INSERT INTO $table($stringData) VALUES ($holderData)";
            $create = $mysqlClient->prepare($SQLquery);

            $postData['password'] = password_hash($postData['password'], $postData['login']);
            
            $create->execute($postData);

                    $_SESSION['CREATE_MESSAGE_SUCCESS'] = "Le compte a bien été crée.";

            break;
        }
        
    }


    // ============================================================================
    // REDIRECTION VERS LA PAGE D'ACCUEIL
    // ============================================================================

    /*
     * Dans tous les cas (succès ou échec), on redirige vers l'accueil
     * - En cas de succès : l'utilisateur verra le contenu réservé
     * - En cas d'échec : l'utilisateur verra le message d'erreur
     */
    redirectToUrl(BASE_URL.'/public/index.php');

