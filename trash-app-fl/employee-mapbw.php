<?php
// SECURITE (commentaires complémentaires : cf. employee.php) :
session_start();
if (isset($_SESSION['employee-login-session']) AND isset($_SESSION['employee-password-session']))
{


    // HEADER :
    include('header.php');


    ///////////////////////////////////////////////////////
    //            RECUPERATION DONNEES DB                //
    ///////////////////////////////////////////////////////

    /////////// I - CONNEXION DB

    include('connect-db.php');


    /////////// II -  CLASS LOAD

    function classLoad($class)
    {
      require $class . '.php';
    }
    spl_autoload_register('classLoad');


    /////////// III - MANAGER INSTANCE

    // on rentre la bonne DB en argument :
    $bwManager = new BulkyWasteManager($db);


    /////////// IV - SELECTION DES DONNEES & PREPARATION AFFICHAGE BW :

    //////// A - PRÉPARATION PAGEMAPS (pagination) :

    ///// 1 - stockage du nombre d'encombrants/bw encore sur la voie publique (non traités/non mis en archives) en variable :
    $bwCount = $bwManager->getBwCount();
    ///// 2 - détermination du nombre de bw affiché sur chaque pagemap :
    $nbBwPerPagemap = 5;
    ///// 3 - détermination du nombre de pagemaps :
    $nbPagemap = ceil($bwCount/$nbBwPerPagemap);// ceil pour arrondir à l'entier supérieur

    ///// 4 - détermination de la pagemap courante ("$currentPagemap") :
    // Si l'utilisateur a demandé à avoir la map complète (tous les bw) :
    if (isset($_GET['completemap']))    
    {
        // on est en-dehors des blocs pagemap habituels :
        $currentPagemap = 0;
    }
    // Sinon :
    else
    {
        // s'il y a eu demande de n° de pagemap ("$_GET['pagemap']") ...
        if (isset($_GET['pagemap']))
        {
            // ... on doit récupérer ce n° pour l'utiliser :
            $currentPagemap = $_GET['pagemap'];
        }
        // sinon :
        else
        {
            // il s'agit d'un premier accès : on doit donc arriver sur la pagemap 1 :
            $currentPagemap = 1;
        }
    }
    //////// A


    //////// B - SELECTION DONNEES :

    // Si l'utilisateur a demandé à avoir la map complète (COMPLETEMAP) :
    if (isset($_GET['completemap']))    
    {
        ///// 1 - On sélectionne les encombrants/bw :
        // a - "WHERE archives=0" : encore sur la voie publique (non traités/non mis en archives),
        // b - "ASC" : en commençant par les premiers déclarés pour aller vers les derniers déclarés
        $q = $db->query('SELECT * FROM ta_bulkywaste WHERE archives=0 ORDER BY id ASC');
    }
    // Sinon : on est dans le cadre des PAGEMAPS :
    else
    {
        ///// 2 - On détermine les éléments contenus dans chaque pagemap : après "LIMIT" :
        // a - "($currentPagemap-1)*$nbBwPerPagemap" : élément de la table à partir duquel on commence :
        // sur la pagemap 1, cela doit être 0 (l'ordinateur considère que le 1er élément affiché est le 0ème),
        // sur la pagemap 2, cela doit correspondre au nombre total de d'éléments par pagemap (ici 1 * $nbBwPerPagemap donc le "$nbBwPerPagemap"ème pour l'ordinateur), etc.
        // -> pour retrouver sur le bon élément en haut de la liste.
        // b - "$nbBottlesPerPage" après "', '" : nombre d'éléments à afficher par pagemap.
        $q = $db->query('SELECT * FROM ta_bulkywaste WHERE archives=0 ORDER BY id ASC LIMIT ' . ($currentPagemap-1)*$nbBwPerPagemap . ', ' . $nbBwPerPagemap . '');
    }
    //////// B


    //////// C - PREPARATION AFFICHAGE (création balises "marker") :

    // AFFICHAGE :
    // On parcourt toutes les lignes de la table et on les intègre dans les attributs de chaque balise "marker" créée :
    while ($row = $q->fetch())
    {
          // Le terme "marker" est ici important pour que JS le reconnaisse :
          echo '<marker ';
          echo 'id="' . $row['id'] . '" ';
          echo 'dat="' . $row['dat'] . '" ';
          echo 'type="' . $row['type'] . '" ';
          echo 'lat="' . $row['lat'] . '" ';
          echo 'lng="' . $row['lng'] . '" ';
          echo 'address="' . $row['address'] . '" ';
          echo '/>';
    }
    //////// C
    /////////// IV
    ?>


    <!-- ////////////////////////////////////// -->
    <!-- //             RENDU                // -->
    <!-- ////////////////////////////////////// -->

    <div class="adapt-height"><!-- adapt-height div -->

        <div class="text-align-center">

            <div id="main-ajax-div">

                <h3>Localisation des<br/>encombrants</h3>

                <p>Pour retirer un encombrant,<br/><span class="underline">cliquez</span> sur son marker</p>

                <p class="font-size-13px italic">> du 1er au dernier déclaré :</p>

                <ul class="bloc-pagemap-ul"><!-- bloc-pagemap-ul -->


                <?php
                //////// I - BLOCS PAGEMAP (PAGINATION)

                // Pagination pagemaps : commence à 1 et doit aller jusqu'au nombre total de pagemaps :
                for ($i=1; $i <= $nbPagemap ; $i++)
                {
                    
                    ///// A - BLOC PAGEMAP == PAGEMAP ACTIVE

                    // Si : n° bloc pagemap ($i) == pagemap sur laquelle on est :
                    // => le contenu du bloc pagemap doit apparaître en gras + italique, et ne doit renvoyer nulle part :
                    if ($i == $currentPagemap)
                    {
                        // 1 - si on est sur la dernière pagemap, on doit afficher "... à [le dernier encombrant déclaré"]" :
                        if ($i == $nbPagemap)
                        {
                        ?>
                            
                            <li class="bold italic"><?php echo ($i-1)*$nbBwPerPagemap+1; ?> à <?php echo $bwManager->getBwCount(); ?></li>

                        <?php
                        }
                        // 2 - sinon : on affiche le dernier bw (max) que peut contenir le bloc pagemap
                        else
                        {
                        ?>

                            <li class="bold italic"><?php echo ($i-1)*$nbBwPerPagemap+1; ?> à <?php echo $i*$nbBwPerPagemap; ?></li>
                        
                        <?php
                        }
                    }// ($i == $currentPagemap)
                    ///// A
                    

                    ///// B - BLOC PAGEMAP != PAGEMAP ACTIVE

                    // Si : n° pagemap ($i) != pagemap sur laquelle on est :
                    // => le bloc pagemap doit renvoyer vers la pagemap correspondante :
                    else// !if ($i == $currentPagemap)
                    {
                        // 1 - si on est sur la dernière pagemap (idem) :
                        if ($i == $nbPagemap)
                        {
                        ?>
                            
                            <li><a href="employee-mapbw.php?pagemap=<?php echo $i; ?>"><?php echo ($i-1)*$nbBwPerPagemap+1; ?> à <?php echo $bwManager->getBwCount(); ?></a></li>

                        <?php
                        }
                        // 2 - sinon (idem) :
                        else
                        {
                        ?>

                            <li><a href="employee-mapbw.php?pagemap=<?php echo $i; ?>"><?php echo ($i-1)*$nbBwPerPagemap+1; ?> à <?php echo $i*$nbBwPerPagemap; ?></a></li>
                        
                        <?php
                        }

                    }// !if ($i == $currentPagemap)
                    ///// B
                
                }// end for

                
                ///// C - BLOC COMPLETEMAP
                
                // Si l'utilisateur a demandé à avoir la map complète :
                if (isset($_GET['completemap']))    
                {
                ?>


                    <li class="bold italic"><a href="employee-mapbw.php?completemap=1">Tous</a></li>
                

                <?php   
                }
                // Sinon :
                else
                {
                ?>


                    <li><a href="employee-mapbw.php?completemap=1">Tous</a></li>
                

                <?php
                }
                ///// C    
                //////// I
                ?>


                </ul><!-- bloc-pagemap-ul -->

                <!-- SMALL-AJAX-DIV -->
                <div id="small-ajax-div"></div>
                

                <!-- MAP -->
                <div class="display-flex justify-content-center padding-bottom-10px">
                    <!-- div contenant la map : -->
                    <div id="map" class="bwmap-div"></div>
                </div>

                <!-- BOUTON "AFFICHER TOUT" -->
                <a href="employee-mapbw.php?completemap=1"><button class="btn main-btn-style">AFFICHER TOUT</button></a>
                <p class="font-size-13px padding-bottom-5px">(zoomez pour voir les encombrants<br/>proches d'un point)</p>


                <?php
                // Si l'utilisateur a demandé à avoir la map complète :
                // on n'affiche pas de tableau (qui serait trop chargé)
                if (isset($_GET['completemap']))    
                {
                }
                // Sinon : affichage du tableau :
                else
                {
                ?>


                    <!-- TABLEAU -->
                    <div class="display-flex justify-content-center padding-bottom-10px"><!-- espace tableau -->

                        <div class="padding-bottom-10px map-width-adjust vert-eau-bkgd black-font-color">

                            <h3 class="italic underline">Encombrants affichés :</h3>

                                <table class="font-size-13px">

                                    <tr><!-- ligne d'en-tête -->
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Localisation</th>
                                    </tr>


                                    <?php
                                    // Affichage de la liste des encombrants :
                                    // On rentre en variable la liste (array) contenant les objets encombrants/bw :
                                    // $bwList = $bwManager->getBwList();
                                    // Pour chaque OBJET "bw" présent dans cette liste/array : on le "saisit" et on en affiche le type et la localisation (via le getter de la class "BulkyWaste") :

                                    // libération du curseur pour la requête ci-dessous :
                                    $q->closeCursor();
                                    $q = $db->query('SELECT * FROM ta_bulkywaste WHERE archives=0 ORDER BY id ASC LIMIT ' . ($currentPagemap-1)*$nbBwPerPagemap . ', ' . $nbBwPerPagemap . '');

                                    while ($row = $q->fetch())
                                    {
                                        echo '<tr>';// lignes en dessous de la ligne d'en-tête
                                            echo '<td>' . $row['dat'] . '</td>';
                                            echo '<td>' . $row['type'] . '</td>';
                                            echo '<td>' . $row['address'] . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>

                                </table>
                        
                        </div>
                    
                    </div><!-- espace tableau -->


                <?php
                }// end - else : affichage du tableau
                ?>


            <a href="employee.php"><button class="btn default-btn-style">RETOUR</button></a>

            </div><!-- main-ajax-div -->

        </div><!-- text-align-center -->

    </div><!-- adapt-height div -->



    <script type="text/javascript">
    ///////////////////////////////////////////////////////////////
    //                  SCRIPT GOOGLE MAP                        //
    // commentaires complémentaires : cf. "user-mapbw-click.php" //
    ///////////////////////////////////////////////////////////////

    /////////// I - DEFINITION variables/arrays/objects

    //////// A - DEFINITION "customLabels"
        
    // ARRAY définissant les labels affichés des markers, en fonction de leur "type":
    var customLabels =
    {
        MENAGER:
        {
            label: 'M'
        },
        MOBILIER:
        {
            label: 'B'
        },
        ELECTROMENAGER:
        {
            label: 'E'
        },
        FERRAILLE:
        {
            label: 'F'
        },
        VERT:
        {
            label: 'V'
        },
        POLLUANT:
        {
            label: 'P'
        },
        AUTRE:
        {
            label: 'A'
        }
    };
    //////// A


    /////////// II - INITMAP

    // La fonction initMap initialise et ajoute la carte lors du chargement de la page Web.
    function initMap()
    {
        //////// A - CREATION MAP

        var map = new google.maps.Map(document.getElementById('map'),
        {
            // Initialisation sur la région bordelaise :
            center: {lat: 44.8313329, lng: -0.5861435},
            zoom: 11
        });

        // GEOLOCATION
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
                map.setZoom(14);
            });
        }
        //

        // Création objet "InfoWindow" :
        var infoWindow = new google.maps.InfoWindow;

        //////// A


        //////// B - AFFICHAGE des MARKERS

        // JS va saisir les balises "marker" créées suite à l'appel à la DB pour les rentrer en variable :
        var markers = document.getElementsByTagName('marker');
        
        // Pour chaque "marker" présent dans la variable "markers" :
        Array.prototype.forEach.call(markers, function(markerElem)
        {
            ///// 1 - RECUPERATION (GET) des attributs des balises "marker"

            // > l'id du bw, qui ne sera pas affiché, mais qui permettra d'identifier sur quel bw l'on clique :
            var id = markerElem.getAttribute('id');

            // > le type qui permet de déterminer le label du marker, et qui apparaît dans l'infowindow :
            var type = markerElem.getAttribute('type');
            // > la date qui apparaît en-dessous dans l'infowindow :
            var dat = markerElem.getAttribute('dat');
            // > l'adresse :
            var address = markerElem.getAttribute('address');

            // > l'objet (entré en variable) définissant la POSITION :
            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng'))
                );

            ///// 1


            ///// 2 - CONSTRUCTION CONTENU INFOWINDOW :

            // On créé la DIV principale dans l'infowindow :
            var infowincontent = document.createElement('div');
            
            // Contenu de cette DIV :

            // > Le TYPE en gras du bw dans l'infowindow :
            // on définit la variable mettant le texte en gras :
            var strong = document.createElement('strong');
            // cela s'appliquera sur :
            strong.textContent = type
            // on applique à la DIV principale :
            infowincontent.appendChild(strong);

            // on va à la ligne :
            infowincontent.appendChild(document.createElement('br'));

            // > La DATE du bw :
            // on définit la variable mettant en texte normal :
            var i = document.createElement('i');
            // cela s'appliquera sur :
            i.textContent = dat
            // on applique à la DIV principale :
            infowincontent.appendChild(i);

            // on va à la ligne :
            infowincontent.appendChild(document.createElement('hr'));

            // > L'ADRESSE du bw :
            // on définit la variable mettant en texte normal :
            var text = document.createElement('text');
            // idem :
            text.textContent = address
            // idem :
            infowincontent.appendChild(text);
            
            // on va à la ligne :
            infowincontent.appendChild(document.createElement('br'));

            // > Le BOUTON pour signaler que l'on a traité/enlevé le bw :
            var button = document.createElement('button');
            // le contenu texte du button :
            button.textContent = 'Retiré !'
            // on définit la fonction "onclick" de ce button :
            // donc : au clic sur ce button ...
            button.onclick = function() {
                // ... on met en archives le bw ciblé (via son "id") :
                toConfirmBulkyWasteInArchives(id);
            }
            // idem :
            infowincontent.appendChild(button);

            ///// 2


            ///// 3 - AJOUT MARKER :

            // Pour chaque ligne/bw/marker dans la DB :
            // création d'un objet "customLabel" comprenant le "label" de l'icon, défini en fonction de son "type" renseigné dans la DB (cf. l'array "customLabels" défini plus haut) :
            var customLabel = customLabels[type] || {};
            console.log(customLabel);

            // AJOUT marker :
            var marker = new google.maps.Marker(
            {
                map: map,
                position: point,
                label: customLabel.label
            });

            // Ouverture de l'infowindow au clic sur le marker :
            marker.addListener('click', function()
            {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
            });
            
            ///// 3

        });// end "Array.prototype.forEach.call"

        //////// B

    }// end "function initMap()"

    /////////// II

    ///////////////////////////////////////////////////////////////
    </script>


    <!-- APPEL DE L'API Google Maps : -->
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrWhzlPyuMoM9Xi2DZ5pEgEzSHQBq9zS8&callback=initMap">
    </script>


    <?php
    // FOOTER :
    include('footer.php');


}
else
// SECURITE (commentaires complémentaires : cf. employee.php) :
{
    echo '<p>Cette page est réservée aux employés connectés.</p>';
}
?>