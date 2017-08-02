<?php
// HEADER :
include('header.php');
?>


<div class="adapt-height">

    <div class="text-align-center">

        <h3>2ème étape :</h3>
       
        <p>Indiquez sa <span class="bold">localisation</span></p>
        
        <p class="padding-top-10px italic">Vous préférez...</p>
        
        <!-- div comportant les 3 choix : -->
        <div class="display-flex flex-direction-column align-items-center">

            <form action="user-mapbw-click.php" method="post" class="display-flex justify-content-center">
                <!-- -> récupérer avec POST la valeur postée précédemment (le "name" est donc important) : -->
                <input type="hidden" name="bw-type" value="<?php echo $_POST['bw-type']; ?>"/>
                <!-- Bouton déclencheur seulement : -->
                <input type="submit" value="CLIQUER" class="btn main-btn-style">
                <div class="btn-annex display-flex align-items-center text-align-left">sur une carte</div>
            </form>

            <div class="between-btn-margin"></div>

            <form action="user-mapbw-geoloc.php" method="post" class="display-flex justify-content-center">
                <input type="hidden" name="bw-type" value="<?php echo $_POST['bw-type']; ?>"/>
                <input type="submit" value="GEOLOCALISER" class="btn main-btn-style">
                <div class="btn-annex display-flex align-items-center text-align-left">votre position avec celle de l'encombrant</div>
            </form>

            <div class="between-btn-margin"></div>

            <form action="user-mapbw-typeaddress.php" method="post" class="display-flex justify-content-center">
                <input type="hidden" name="bw-type" value="<?php echo $_POST['bw-type']; ?>"/>
                <input type="submit" value="RENSEIGNER" class="btn main-btn-style">
                <div class="btn-annex display-flex align-items-center text-align-left">l'adresse</div>
            </form>

        </div><!-- div comportant les 3 choix -->
        
        <p class="font-size-13px">(Type d'encombrant : <span class="bold"><?php echo $_POST['bw-type']; ?></span>)</p>

        <a href="user-type.php"><button class="btn default-btn-style">RETOUR</button></a>

    </div><!-- text-align-center -->

</div>


<?php
// FOOTER :
include('footer.php');
?>