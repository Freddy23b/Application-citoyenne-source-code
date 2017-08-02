<!DOCTYPE html>
<html lang="fr">


<head>

    <!-- Encodage : -->
    <meta charset="UTF-8">

    <!-- Title : -->
    <title>Appli citoyenne</title>

    <!-- l'icône de l'onglet -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

    <!-- Méta-description : -->
    <meta name="description" content="Application citoyenne : signalisation d'encombrants et demande d'enlèvement">

    <!-- -> lisibilité sur mobiles : -->
    <meta name="viewport" content="width=device-width"/>


    <?php
    ///// FONCTIONNEMENT DATEPICKER
    // Si on est sur la page "user-rdv.php", on utilise jQuery UI :
    if (isset($activePage) && $activePage == 'user-rdv')
    {
    ?>


        <!-- ///// I - JS -->
        <!-- // A - jQuery (general) : -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <!-- // B - jQuery UI : -->
        <!-- * CDN : -->
        <!-- <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
        <!-- * Fichier : -->
        <script type="text/javascript" src="js/jquery-ui.js"></script>


        <!-- ///// II - CSS -->
        <!-- // A - jQuery UI : -->
        <!-- * CDN -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <!-- * Fichier : -->
        <!-- (cette version n'étant pas complète, on charge plutôt le CDN) -->
        <!-- <link rel="stylesheet" href="css/jquery-ui.css"> -->


    <?php
    }
    ?>


    <!-- // B - style.css personnalisé : -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>


<body class="vert-chrome-bkgd">

    <header class="header display-flex justify-content-center">

        <a href="index.php">
            <img src="img/logo.png" alt="Logo Appli citoyenne" title="Accueil principal" class="trash-app-logo" />
        </a>
        
        <div class="between-logo-h1-margin"></div>

        <a href="index.php">
            <h1 class="h1 text-align-center">Appli citoyenne</h1>
        </a>

    </header>
