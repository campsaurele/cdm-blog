<?php
    
require_once(__DIR__.'/../common/config/config.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cdm-blog/public/assets/css/style.css">
    <title>CDM 2026 - Accueil</title>
</head>
<body>


<?php include __DIR__.('/../common/layout/header.php');


if (!isset($_SESSION['LOGGED_USER'])) : ?>
<section class="d-flex justify-content-center align-content-center">

    <div class="card col-12 col-md-4 p-3">
        <h2 class="mb-3">Pour accéder au contenu, connectez-vous</h2>
 
        <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Se connecter
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <form class="accordion-body" action="../common/components/login-post.php" method="POST">

            <?php if (!empty($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    // htmlspecialchars() protège contre les injections XSS
                    echo htmlspecialchars($_SESSION['LOGIN_ERROR_MESSAGE']);
                // Suppression du message pour qu'il ne s'affiche qu'une fois
                unset($_SESSION['LOGIN_ERROR_MESSAGE']);
                ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="connect-login" class="form-label">Login</label>
                <input type="text" class="form-control" id="connect-login" name="login" required
                aria-describedby="login-help" placeholder="charlie123">
                <div id="login-help" class="form-text">Le login utilisé lors de la création de compte.</div>
            </div>

            <div class="mb-3">
                <label for="login-password" class="form-label">Mot de passe</label>

                <input type="password" class="form-control" id="login-password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary" name="action" value="connect">Envoyer</button>
        </form>
            </div>
  </div>

            <!-- Create account form - accordion item2 -->
            <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Créer un compte
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse"aria-labelledby="headingTwo" data-bs-parent="#accordionExample">

                    <form class="accordion-body" action="../common/components/login-post.php" method="POST">


                    <div class="mb-3">
                    <label for="create_login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="create_login" name="login" required
                        aria-describedby="login-help" placeholder="charlie123">
                    </div>

                    <div class="mb-3">
                        <label for="create_password" class="form-label">Mot de passe</label>

                        <input type="password" class="form-control" id="create_password" name="password" onkeyup='checkPassword();' required />
                        <div id="password-help" class="form-text">
                        Doit contenir obligatoirement :    
                        <ul>
                                <li id="nbcar">6 caractères</li>
                                <li id="majcar">1 majuscule</li>
                                <li id="speccar">1 caractère spéciale</li>
                            </ul> </div>
                        <label for="confirm_password" class="form-label">Confirmez le mot de passe</label>
                        <input type="password" class="form-control" id="confirm_password" disabled="true"  onkeyup='matchPassword();' /> 
                        <span id='message'></span>
                    </div>

                    <button type="submit" class="btn btn-primary mb-3" id="create_submit" name="action" value="create" disabled="true">Envoyer</button>
                    
            <!-- Message Erreur / Confirmation for Account Creation -->
                    <?php if (!empty($_SESSION['CREATE_MESSAGE'])) : ?>
                    <div class="alert alert-danger" role="alert">
                    <?php
                    // htmlspecialchars() protège contre les injections XSS
                    echo htmlspecialchars($_SESSION['CREATE_MESSAGE']);
                    // Suppression du message pour qu'il ne s'affiche qu'une fois
                    unset($_SESSION['CREATE_MESSAGE']);
                    ?>
                    </div>
                    <?php elseif (!empty($_SESSION['CREATE_MESSAGE_SUCCESS'])) : ?>
                    <div class="alert alert-success" role="alert">
                                         <?php
                    // htmlspecialchars() protège contre les injections XSS
                    echo htmlspecialchars($_SESSION['CREATE_MESSAGE_SUCCESS']);
                    // Suppression du message pour qu'il ne s'affiche qu'une fois
                    unset($_SESSION['CREATE_MESSAGE_SUCCESS']);
                    ?>   
                    
                    </div>
                    <?php endif; ?>  
                </form>
             </div>
            </div>
        </div>

    </div>


    

    </section>
<?php else :
    // ============================================================================
    // CAS 2 : UTILISATEUR CONNECTÉ - Affichage de la modale de bienvenue
    // ============================================================================

    /*
     * Vérification si la modale a déjà été affichée
     * On utilise $_SESSION['MODAL_SHOWN'] pour ne l'afficher qu'une seule fois
     */
    if (!isset($_SESSION['MODAL_SHOWN'])) :
        // Marquage : la modale sera affichée, on ne la montrera plus après
        $_SESSION['MODAL_SHOWN'] = true;
        ?>
        <!-- Modale Bootstrap (popup) -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- En-tête de la modale -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Bonjour <?php echo $_SESSION['LOGGED_USER']['nom']; ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Corps de la modale -->
                    <div class="modal-body">
                        Bienvenue sur le site de l'équipe ! <br>
                        Vous avez à présent accès aux articles et résultats sportifs.
                    </div>

                    <!-- Pied de la modale -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>



        <!--
            Script JavaScript pour afficher automatiquement la modale
            DOMContentLoaded : attend que la page soit complètement chargée
        -->
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // Création d'une instance de modale Bootstrap
                const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                // Affichage de la modale
                myModal.show();
            });
        </script>
<?php
    endif; // Fin de la vérification MODAL_SHOWN
endif; // Fin de la vérification LOGGED_USER
?>
            <!-- Import de Bootstrap JavaScript (nécessaire pour les modales) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/cdm-blog/public/assets/js/script.js"></script>
</body>
</html>