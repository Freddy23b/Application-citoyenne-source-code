<?php
// SECURITE (commentaires complémentaires : cf. employee.php) :
session_start();
if (isset($_SESSION['employee-login-session']) AND isset($_SESSION['employee-password-session']))
{
    

    // HEADER :
    include('header.php');


    // CONNEXION DB :
    include('connect-db.php');


    //////// I - PREPARATION PAGINATION

    ///// A - décompte du nombre de rdv non traités & stockage de ce nombre en variable :
    $q = $db->query('SELECT COUNT(id) AS plannedRdvCount FROM ta_rdv WHERE archives=0');
    $data = $q->fetch();
    $plannedRdvCount = $data['plannedRdvCount'];
    // var_dump($plannedRdvCount);

    ///// B - détermination du nombre de rdv affichés par page :
    $nbPlannedRdvPerPage = 4;

    ///// C - détermination du nombre de pages :
    $nbPage = ceil($plannedRdvCount/$nbPlannedRdvPerPage);// ceil pour arrondir à l'entier supérieur
    // var_dump($nbPage);

    ///// D - définition de la currentPage :
    
    // s'il y a eu demande d'un n° de page ("$_GET['page']") ...
    if (isset($_GET['page']))
    {
        // ... on doit récupérer ce n° pour l'utiliser :
        $currentPage = $_GET['page'];
    }
    // sinon :
    else
    {
        // il s'agit d'un premier accès : on doit donc arriver sur la pagemap 1 :
        $currentPage = 1;
    }
    //////// I
    ?>


    <div  class="adapt-height padding-top-10px padding-bottom-10px">

        <div class="text-align-center">

            <div id="main-ajax-div">

                <h3>Demandes d'enlèvements<br/>(RDV)</h3>

                <!-- SMALL-AJAX-DIV -->
                <div id="small-ajax-div"></div>

                <div class="display-flex justify-content-center padding-top-10px"><!-- table-container -->

                    <table class="rdv-table">

                        <tr class="italic font-size-13px">
                            <th>Date</th><!-- 1 -->
                            <th>Heure</th><!-- 2 -->
                            <th>Nom</th><!-- 3 -->
                            <th>Email</th><!-- 4 -->
                        </tr>


                        <?php
                        // AFFICHAGE de la liste des rdv non traités / archivés :
                        // 1/2 : "$q" -> on sélectionne toutes les lignes de la table "rdv", et on sélectionne les champs mentionnés après "SELECT" :
                        // "ASC" : on trie par date croissante pour avoir les dates les + proches en 1er :
                        // libération du curseur pour la requête qui suit :
                        $q->closeCursor();
                        $q = $db->query('SELECT id, rdvdate, rdvhour, rdvaddress, rdvname, rdvemail FROM ta_rdv WHERE archives=0 ORDER BY rdvdate ASC LIMIT ' . ($currentPage-1)*$nbPlannedRdvPerPage . ', ' . $nbPlannedRdvPerPage . '');

                        // 2/2 : pour chaque ligne/"$row" prise dans la requête "$q" (qui couvre toutes les lignes de la table) :
                        foreach ($q as $row)
                        {
                        ?>


                            <tr class="tr1-tds font-size-13px">
                                <td><?php echo $row['rdvdate']; ?></td><!-- 1 -->
                                <td><?php echo $row['rdvhour']; ?></td><!-- 2 -->
                                <td><?php echo $row['rdvname']; ?></td><!-- 3 -->
                                <td><?php echo $row['rdvemail']; ?></td><!-- 4 -->
                            </tr>

                            <tr class="tr2-tds font-size-13px">
                                <td class="italic bold vert-tilleul-font-color">Adresse :</td><!-- 1 -->
                                <td colspan="3"><?php echo $row['rdvaddress']; ?></td><!-- 2\3\4 -->
                            </tr>

                            <tr class="tr3-tds">
                                <td colspan="4"><!-- 1\2\3\4 -->
                                    <!-- Avec ce href, on fait un lien vers la balise ancre définie par son id (href="#id_de_l-ancre" -> <... id="id_de_l-ancre">), pour y amener l'utilisateur : -->
                                    <a href="#small-ajax-div"><button onclick="toConfirmRdvInArchives(<?php echo $row['id']; ?>);" class="btn long-btn-style">Traité !</button></a>
                                </td>
                            </tr>


                        <?php
                        }
                        ?>


                    </table>

                </div><!-- table-container -->

                <ul class="pages-ul"><!-- pages-ul -->


                <?php
                //////// I - BLOCS PAGEMAP (PAGINATION)

                // Pagination pagemaps : commence à 1 et doit aller jusqu'au nombre total de pagemaps :
                for ($i=1; $i <= $nbPage ; $i++)
                {

                    ///// A - n° page == page active

                    // Si : n° page ($i) == page sur laquelle on est :
                    // => le n° de page doit apparaître en gras + italique, et ne doit renvoyer nulle part :
                    if ($i == $currentPage)
                    {
                    ?>

                            
                        <li class="bold italic"><?php echo $i; ?></li>

                    
                    <?php
                    }// ($i == $currentPage)
                    ///// A
                    

                    ///// B - n° page != page active

                    // Si : n° page ($i) != pagemap sur laquelle on est :
                    // => le n° de page doit renvoyer vers la page correspondante :
                    else// !if ($i == $currentPage)
                    {
                    ?>

                            
                        <li><a href="employee-rdv.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>


                    <?php
                    }// !if ($i == $currentPage)
                    ///// B
                
                }// end for
                ?>


                </ul><!-- pages-ul -->

                <a href="employee.php"><button class="btn default-btn-style">RETOUR</button></a>

            </div><!-- main-ajax-div -->

        </div><!-- text-align-center -->

    </div>


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