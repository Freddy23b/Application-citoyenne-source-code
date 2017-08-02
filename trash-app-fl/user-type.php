<?php
// HEADER :
include('header.php');
?>


<div class="adapt-height padding-top-20px">

    <div class="text-align-center">

        <!-- Déclaration du TYPE de l'ENCOMBRANT -->
        <h3>1ère étape :</h3>

        <p>Renseignez le <span class="bold">type</span> de l'encombrant :</p>

        <div class="display-flex justify-content-center">

            <form action="user-loc.php" method="post">
            
                <select name="bw-type" id="bw-type">
                    <option value="MENAGER">Déchet ménager</option>
                    <option value="MOBILIER">Mobilier</option>
                    <option value="ELECTROMENAGER">Electroménager</option>
                    <option value="FERRAILLE">Ferraille</option>
                    <option value="VERT">Déchet vert/bois</option>
                    <option value="POLLUANT">Polluant</option>
                    <option value="AUTRE">Autre</option>
                </select>

                <input type="submit" value="OK" class="btn default-btn-style">
                
            </form>

        </div>

    </div><!-- text-align-center -->

</div>


<?php
// FOOTER :
include('footer.php');
?>