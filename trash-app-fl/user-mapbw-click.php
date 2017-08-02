<?php
// HEADER :
include('header.php');
?>


<div class="adapt-height">

    <div class="text-align-center">

        <div id="main-ajax-div">

            <p class="font-size-13px">(Type d'encombrant : <span class="bold"><?php echo $_POST['bw-type']; ?></span>)</p>

            <div id="small-ajax-div">
                
                <p>Pointez sur l'endroit où<br/>se trouve l'encombrant :</p>

            </div><!-- small-ajax-div -->
            
            <div class="display-flex justify-content-center padding-bottom-5px">
                <!-- div contenant la map : -->
                <div id="map" title="Vous pouvez cliquer sur la carte pour renseigner la localisation de l'encombrant" class="bwmap-div"></div>
            </div>
            
            <!-- si clic "RETOUR" -> on doit pouvoir revenir sur la page précédente en transmettant à nouveau le type du bw via $_POST : -->
            <form action="user-loc.php" method="post">
                <!-- -> récupérer avec POST la valeur postée précédemment (le "name" est donc important) : -->
                <input type="hidden" name="bw-type" value="<?php echo $_POST['bw-type']; ?>"/>
                <!-- Bouton déclencheur seulement : -->
                <input type="submit" value="RETOUR" class="btn default-btn-style"/>
            </form>

        </div><!-- ajax-div -->

    </div><!-- text-align-center -->

</div>


<script type="text/javascript">
////////////////////////////////////////////////////////


///// I - DEFINITION VARIABLES / OBJECTS

// On définit notre OBJET BW :
var bwJsObject =
{
    // On récupère ce qui a été posté précédemment :
    type: '<?php echo $_POST['bw-type']; ?>',
    lat: 0,
    lng: 0,
    address: 'non définie'
};
console.log(bwJsObject);


// on définit l'array "infowindows" qui contiendra la référence à l'infowindow rajoutée :
var infowindows = [];

///// I


///// II - INITMAP()

function initMap()
{
    // "new google.maps.Map()" : nouvel objet Google Maps créant la map (la classe JavaScript qui représente une carte est la classe "Map" ; on entre dans le constructeur de cette class la div dans laquelle on veut intégrer la carte)
    // "getElementById('map')" : la map s'inclura dans la div avec l'id "map"
    var map = new google.maps.Map(document.getElementById('map'),
    {
        // Initialisation sur la région bordelaise :
        center: {lat: 44.8313329, lng: -0.5861435},
        zoom: 11
    });


    // GEOLOCATION

    // Try HTML5 geolocation
    // si le navigateur ne supporte pas la geolocation, il ne la proposera pas :
    if (navigator.geolocation)
    {
        // (Demandera l'autorisation à l'utilisateur)
        navigator.geolocation.getCurrentPosition(function(position)
        {
            var pos =
            {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            // Pour centrer la carte au niveau de la "pos" définie avec la geolocation, et on zoom (étant donné que l'utilisateur a ici accepté la géolocalisation) : 
            map.setCenter(pos);
            map.setZoom(16);
        });
    }
    //
    

    // Au clic sur la map :
    google.maps.event.addListener(map, 'click', function(event)
    {
        // On appelle la fonction d'ajout d'une infowindow :
        addInfowindow(event.latLng, map);
    });

}// end - "function initMap()"

///// II


///// III - AJOUT INFOWINDOW

function addInfowindow(location, map)
{
    // On injecte les valeurs lat et lng, comprises dans l'objet "location", dans l'objet bw :
    // ("location" == "event.latLng" est rentré en argument dans la fonction "addInfowindow()")
    bwJsObject.lat = location.lat();
    bwJsObject.lng = location.lng();

    // S'il existe (n'est pas "undefined") : suppression du précédent infowindow (indexé 0 dans l'ARRAY "infowindows") :
    if (typeof infowindows[0] !== 'undefined')
    {
        // on cible le 1er infowindow ajouté, dont l'index est 0
        // et on retire son affichage :
        infowindows[0].setMap(null);
        
        // on vide l'ARRAY "infowindows" : ainsi, le prochain index rentré sera à nouveau 0
        infowindows = [];
    }

    // AJOUT de l'infowindow (objet "google.maps.InfoWindow") :
    var infowindow = new google.maps.InfoWindow(
    {
        // position de l'infowindow :
        position: location,

        // map concernée :
        map: map
    });

    // On intègre "infowindow" dans l'array :
    infowindows.push(infowindow);

///// III


    ///// IV - GEOCODAGE INVERSE (latlng --> adresse)

    var geocoder = new google.maps.Geocoder;

    // on appelle ENSUITE la fonction "geocodeLatLng()" définie plus bas :
    geocodeLatLng(geocoder, map);

    // Fonction géocodage inversé (clic sur map ==> latlng --> adresse) :
    function geocodeLatLng(geocoder, map)
    {
        // On définit la variable "latlng", qui contiendra les géo-données - récupérées lors de l'ajout de l'infowindow avec la fonction "addInfowindow()" - sur lesquelles s'appliquera le géocodage inversé.
        var latlng =
        {
            lat: bwJsObject.lat,
            lng: bwJsObject.lng
        };

        // On a la variable "latlng" : on la rentre en argument dans la fonction/method "geocode" (de l'objet "geocoder" instancié plus haut) :
        geocoder.geocode({'location': latlng}, function(results, status)
        {
            // 1ère condition à remplir pour que le geocodage fonctionne :
            if (status === 'OK')
            {
                // 2ème condition à remplir :
                if (results[0])
                {
                    // On rentre dans notre objet la valeur adresse :
                    bwJsObject.address = results[0].formatted_address;
                    // console.log(bwJsObject);
    ///// IV


                    ///// V - AFFICHAGE ADRESSE POUR CONFIRMATION

                    // Régler le CONTENU DE L'INFOWINDOW :
                    infowindow.setContent(bwJsObject.address + '<hr/><i>Adresse seulement indicative</i>');

                    // On charge dans la "small-ajax-div" l'affichage de la demande de confirmation :
                    toConfirmAddBulkyWaste();
                    
                    ///// V


// CLOSING //////
                }
                // if (!results[1]) :
                else
                {
                    window.alert('No results found');
                }
            }
            // if (status != 'OK') :
            else
            {
                // affiche le pb de "status" (non 'OK') rencontré :
                window.alert('Geocoder failed due to: ' + status);
            }

        });// end - "geocoder.geocode()"

    }// end - "function geocodeLatLng()"
    
}// end - "function addInfowindow(location, map)"
// CLOSING //////


</script>


<!-- APPEL DE L'API Google Maps : -->
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrWhzlPyuMoM9Xi2DZ5pEgEzSHQBq9zS8&callback=initMap">
</script>


<?php
// FOOTER :
include('footer.php');
?>