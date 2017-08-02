<?php
// HEADER :
include('header.php');
?>


<div class="adapt-height">
    
    <div class="text-align-center">

        <div id="main-ajax-div">

            <p class="padding-bottom-10px font-size-13px">(Type d'encombrant : <span class="bold"><?php echo $_POST['bw-type']; ?></span>)</p>

            <h3>Géolocalisation :</h3>

            <div id="small-ajax-div">
            
                <p class="font-size-13px">Attente des résultats<br/>de géolocalisation ...</p>
                
            </div><!-- small-ajax-div -->

            <div class="display-flex justify-content-center padding-bottom-5px">
                <!-- div contenant la map : -->
                <div id="map" class="bwmap-div"></div>
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
// commentaires complémentaires : cf. "user-mapbw-click.php"


///// I - DEFINITION VARIABLES / OBJECTS

// On définit notre OBJET BW :
var bwJsObject =
{
    type: '<?php echo $_POST['bw-type']; ?>',
    lat: 0,
    lng: 0,
    latlng: 0,
    address: 'non définie'
};
console.log(bwJsObject);

///// I


///// II - INITMAP()

function initMap()
{
    var map = new google.maps.Map(document.getElementById('map'),
    {
        center: {lat: 44.8313329, lng: -0.5861435},
        zoom: 11
    });


    // création d'un objet "google.maps.Geocoder"
    var geocoder = new google.maps.Geocoder;

    // création d'un objet "google.maps.InfoWindow"
    // ici : bien appliquer l'infowindow à "map" pour que l'infowindow s'ouvre sur la map :
    var infoWindow = new google.maps.InfoWindow({map: map});


    ///// II - GEOLOCATION

    // Try HTML5 geolocation.
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(function(position)
        {
            var pos =
            {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
        
            // On renseigne l'objet "bwJsObject" :
            bwJsObject.latlng = pos;
            bwJsObject.lat = pos.lat;
            bwJsObject.lng = pos.lng;
            console.log(bwJsObject);

            // On centre la carte sur le point géolocalisé, et on zoom :
            map.setCenter(pos);
            map.setZoom(16);

    ///// II


            ///// III - GEOCODAGE INVERSE (latlng --> adresse)

            // appel à la fonction pour géocoder :
            geocodeLatLng(geocoder, map);

            // Fonction géocodage inversé :
            // (click sur map --> latlng  -->  converties en adresse)
            function geocodeLatLng(geocoder, map)
            {
                // On rentre la bonne localisation ("bwJsObject.latlng") en argument dans la fonction/method "geocode" :
                geocoder.geocode({'location': bwJsObject.latlng}, function(results, status)
                {
                    if (status === 'OK')
                    {
                        // à ce stade, l'adresse formatée "results[0].formatted_address" (résultant du géocodage inversé) est définie.
                        if (results[0])
                        {
                            // On renseigne l'objet "bwJsObject" :
                            bwJsObject.address = results[0].formatted_address;
                            console.log(bwJsObject);
            
            ///// III - GEOCODAGE INVERSE (latlng --> adresse)


                            ///// IV - INFOWINDOW

                            // Réglage de la POSITION de l'infowindow :
                            infoWindow.setPosition(pos);

                            // Définition du CONTENU de l'infowindow :
                            // -> Il faut definir le contenu de l'infowindow (avec le géocodage inversé) AVANT D'AFFICHER cette infowindow (avec le "infoWindow.setContent" ci-dessous).
                            // Le risque est d'afficher une infowindow au contenu "non défini" : l'utilisation d'AJAX permet en effet au navigateur de lire le code qui fait suite au géocodage, sans encore avoir exécuté ce géocodage.
                            // le fait de définir le contenu de l'infowindow ici, à l'intérieur de la fontion de géocodage et à la fin, obligera le navigateur à ouvrir l'infowindow seulement après avoir défini ce contenu :
                            infoWindow.setContent(bwJsObject.address + '<hr/><i>Adresse seulement indicative</i>');

                            // On charge dans la "small-ajax-div" l'affichage de la demande de confirmation :
                            toConfirmAddBulkyWaste();

                            ///// IV


// CLOSING //////////////
                        }
                        // if (!results[0]) :
                        else
                        {
                          window.alert('No results found');
                        }
                    }
                    // if (status !== 'OK') :
                    else
                    {
                        // affiche le pb de "status" (non 'OK') rencontré :
                        window.alert('Geocoder failed due to: ' + status);
                    }

                });// end - "geocoder.geocode()"

            }// end - function "geocodeLatLng()"
        
        },
        function()
        {
            handleLocationError(true, infoWindow, map.getCenter());
        });// end - "navigator.geolocation.getCurrentPosition(function(position)"

    }// end - "if (navigator.geolocation)"
    else
    {
        // Browser doesn't support Geolocation
        alert('Géolocalisation indisponible, désolé !')
    }

}// end - "initMap()"
// CLOSING //////////////


</script>


<!-- APPEL DE L'API Google Maps : -->
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrWhzlPyuMoM9Xi2DZ5pEgEzSHQBq9zS8&callback=initMap">
</script>


<?php
// FOOTER :
include('footer.php');
?>