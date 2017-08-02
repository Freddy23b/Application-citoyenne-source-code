<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
</head>

<body>


    <!-- ///// I - AFFICHAGE DEMANDE CONFIRMATION LOCALISATION \\ pages "user-mapbw-click" \ "user-mapbw-geoloc" -->

    <div id="ajax-loc-confirm">

        <p>Confirmez-vous cette localisation ?</p>

        <div class="display-flex justify-content-center padding-bottom-10px"><!-- btns div -->

            <button onclick="addBulkyWaste();" class="btn default-btn-style">CONFIRMER</button>
            <div class="between-btn-margin"></div>
            <button onclick="closeSmallAjaxDiv();" class="btn default-btn-style">ANNULER</button>

        </div><!-- btns div -->

        <p>ou cliquez à nouveau :</p>

    </div>



    <!-- ///// II - AFFICHAGE DEMANDE CONFIRMATION RETRAIT \\ page "employee-mapbw" -->

    <div id="ajax-take-away-confirm">

        <p>Confirmer le retrait ?</p>

        <div class="padding-bottom-10px display-flex justify-content-center"><!-- btns div -->

            <button onclick="bulkyWasteInArchives(<?php echo $_POST['bw-id']; ?>);" class="btn default-btn-style">CONFIRMER</button>
            <div class="between-btn-margin"></div>
            <button onclick="closeSmallAjaxDiv();" class="btn default-btn-style">ANNULER</button>

        </div><!-- btns div -->

    </div>


    <!-- ///// III - AFFICHAGE DEMANDE CONFIRMATION MISE EN ARCHIVE RDV \\ page "employee-rdv" -->

    <div id="ajax-rdvok-confirm">

        <p>Confirmer le retrait ?</p>

        <div class="padding-bottom-10px display-flex justify-content-center"><!-- btns div -->

            <button onclick="rdvInArchives(<?php echo $_POST['rdv-id']; ?>);" class="btn default-btn-style">CONFIRMER</button>
            <div class="between-btn-margin"></div>
            <button onclick="closeSmallAjaxDiv();" class="btn default-btn-style">ANNULER</button>

        </div><!-- btns div -->

    </div>


    <!-- ///// IV - FERMETURE DE SMALL-AJAX-DIV \\ pages utilisant le présent fichier "ajax.php" -->

    <!-- Div sans contenu pour fermer le contenu précédent : -->
    <div id="ajax-div-closed"></div>


</body>

</html>