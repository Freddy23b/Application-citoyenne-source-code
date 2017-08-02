<?php
// HEADER :
include('header.php');
?>


<div class="adapt-height padding-bottom-20px">

    <div class="text-align-center">

        <div id="main-ajax-div">

            <p class="padding-bottom-10px font-size-13px">(Type d'encombrant : <span class="bold"><?php echo $_POST['bw-type']; ?></span>)</p>
    
            <p>Tapez l'adresse :</p>
            <textarea id="bw-address-posted" name="bw-address-posted" rows="4" maxlength="300" placeholder="Ex : 11 rue..."></textarea>
            
            <div class="display-flex justify-content-center padding-top-10px padding-bottom-10px"><!-- btns div -->

                <button id="typeaddress-bwloc-btn" class="btn default-btn-style">ENVOYER</button>

                <div class="between-btn-margin"></div>

                <!-- en cas d'annulation, on doit pouvoir revenir sur la page précédente en transmettant à nouveau le type du bw via $_POST : -->
                <form action="user-loc.php" method="post">
                    <!-- -> récupérer avec POST la valeur postée précédemment (le "name" est donc important) : -->
                    <input type="hidden" name="bw-type" value="<?php echo $_POST['bw-type']; ?>"/>
                    <!-- Bouton déclencheur seulement : -->
                    <input type="submit" value="RETOUR" class="btn default-btn-style"/>
                </form>
            
            </div><!-- btns div -->
            
            <span class="font-size-13px">Aperçu :</span>

            <!-- div contenant la map : -->
            <div class="display-flex justify-content-center">
                <div id="map" class="bwmap-div"></div>
            </div>

        </div><!-- ajax-div -->

    </div><!-- text-align-center -->

</div><!-- adapt-height -->


<script type="text/javascript">
////////////////////////////////////////////////////////
// commentaires complémentaires : cf. "user-mapbw-click.php"


///// I - DEFINITION VARIABLES / OBJECTS

// On définit notre OBJET BW :
var bwJsObject =
{
    type: '<?php echo $_POST['bw-type']; ?>',
    lat: 0,
    lng: 0,
    address: 'non définie'
};
console.log(bwJsObject);

    
// on définit l'array "infowindows" qui contiendra la référence au infowindow rajouté :
var infowindows = [];

///// I


///// II - INITMAP()

function initMap()
{
    var map = new google.maps.Map(document.getElementById('map'),
    {
        // Initialisation sur la région bordelaise :
        center: {lat: 44.8313329, lng: -0.5861435},
        zoom: 11
    });

///// II


    ///// III - CAPTURE ADRESSE POSTEE -> GEOCODAGE

    // Création d'un objet "google.maps.Geocoder" :
    var geocoder = new google.maps.Geocoder;

    // Au clic sur ...
    var typeaddressBwlocBtn = document.getElementById('typeaddress-bwloc-btn');
    typeaddressBwlocBtn.addEventListener('click', function() {

        // On saisit dans la variable "bwAddress" l'adresse rentrée par l'utilisateur dans le champ :
        var bwAddress = document.getElementById('bw-address-posted').value;

        // VERIFICATION de l'adresse postée :
        // création d'un nouvel objet "RegExp" pour vérifier la longueur de l'adresse postale (entre 5 et 250 charactères ; "\s" pour l'acceptation des sauts de ligne) :
        var addressRegex = /^(.|\s){5,250}$/;
        // on utilise la méthode "test" de l'objet "RegExp" : on teste si ce qui a été rentré par l'utilisateur vérifie la regex :
        var addressTest = addressRegex.test(bwAddress);

        // si le test est négatif :
        if (!addressTest)
        {
            alert('Votre adresse est trop courte, ou trop longue.');
        }
        // sinon, on peut procéder au traitement :
        else
        {
            // Cette adresse doit être enregistrée dans l'objet "bwJsObject" afin de pouvoir être insérée en DB :
            bwJsObject.address = bwAddress;

            // on lance la fonction pour géocoder l'adresse rentrée :
            geocodeAddress(geocoder, map);
        }
    });

    ///// III

}// end - "function initMap()"


///// IV - GEOCODAGE (adresse --> latlng)

function geocodeAddress(geocoder, resultsMap)
{
    // On a l'adresse "bwJsObject.address" : on la rentre en argument dans la fonction/method "geocode" (de l'objet "geocoder" instancié plus haut) :
    geocoder.geocode({'address': bwJsObject.address}, function(results, status)
    {
        if (status === 'OK')
        {
            // on centre la map ( == "resultsMap" == 2ème paramètre de la fonction "geocodeAddress") :
            resultsMap.setCenter(results[0].geometry.location);
            // on zoom :
            resultsMap.setZoom(17);

            // le géocodage étant réalisé, on peut rentrer les lat et lng dans l'objet "bwJsObject" :
            bwJsObject.lat = results[0].geometry.location.lat();
            bwJsObject.lng = results[0].geometry.location.lng();
            // console.log(bwJsObject);

///// IV


            ///// V - AJOUT INFOWINDOW

            // S'il existe (n'est pas indéfini) : suppression du précédent infowindow (indexé 0 dans l'ARRAY "infowindows") :
            if (typeof infowindows[0] !== 'undefined')
            {
                // on cible le 1er infowindow ajouté, dont l'index est 0
                // et on retire son affichage :
                infowindows[0].setMap(null);
                
                // on vide l'ARRAY "infowindows" : ainsi, le prochain index rentré sera à nouveau 0
                infowindows = [];
            }

            // Ajout du infowindow :
            var infowindow = new google.maps.InfoWindow(
            {
                // le infowindow devra s'appliquer sur la map "resultsMap" définie plus haut
                map: resultsMap,
                position: results[0].geometry.location,
                // content: '<button onclick="infowindowClicked();">CLIQUEZ-MOI</button><br/>pour CONFIRMER<br/>ou renseignez à<br/>nouveau le champ'
                content: '<button onclick="addBulkyWaste();">CLIQUEZ-MOI</button><br/>pour CONFIRMER<br/>ou renseignez à<br/>nouveau le champ'
            });
            
            // On intègre "infowindow" dans l'array :
            infowindows.push(infowindow);

            ///// V


// CLOSING
        }
        else// !if (status === 'OK')
        {
            alert('Geocode was not successful for the following reason: ' + status);
        }

    });// end "geocoder.geocode()"

}// end function "geocodeAddress()"
//////////



</script>

<!-- APPEL DE L'API Google Maps : -->
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrWhzlPyuMoM9Xi2DZ5pEgEzSHQBq9zS8&callback=initMap">
</script>


<?php
// FOOTER :
include('footer.php');
?>