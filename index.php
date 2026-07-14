<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cdm-blog/assets/css/style.css">
    <title>CDM 2026 - Accueil</title>
</head>
<body>


<?php include __DIR__.('/layout/header.php');

if (!isset($_SESSION['LOGGED_USER'])) : ?>
<section class="d-flex justify-content-center align-content-center">

    <div class="card col-12 col-md-4 p-3">
 
        <form action="submit-login.php" method="POST">

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
                <h2>Pour accéder au contenu, connectez-vous</h2>
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required
                    aria-describedby="email-help" placeholder="you@exemple.com">
                    <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
            </div>

            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe</label>

                <input type="password" class="form-control" id="mdp" name="mdp" required>
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

        <div class=" accordion">
            <form>
                 <div class="mb-3">
                <h2>Pour accéder au contenu, connectez-vous</h2>
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required
                    aria-describedby="email-help" placeholder="you@exemple.com">
                    <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
            </div>

            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe</label>

                <input type="password" class="form-control" id="mdp" name="mdp" required>
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
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

        <!-- Import de Bootstrap JavaScript (nécessaire pour les modales) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

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
    
</body>
</html>