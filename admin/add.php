<?php require_once(__DIR__.'/../components/button.php'); ?>
<?php require_once(__DIR__.'/../components/crud/create.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cdm-blod/assets/css/style.css">
    <title>Ajout de Contenu</title>
</head>
<body>

    <?php include __DIR__. '/../layout/header.php'; ?>

    <?= create() ?>
    
</body>
</html>