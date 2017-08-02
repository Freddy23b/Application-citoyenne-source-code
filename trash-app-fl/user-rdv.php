<?php
// reconnaissance : on est sur la page "user-rdv" => effectuer le chargement de jQuery UI (pour datepicker) via le header
$activePage = 'user-rdv';

// HEADER :
include('header.php');
?>


<div class="adapt-height padding-bottom-20px">

    <div class="text-align-center">

        <div id="main-ajax-div">

            <h3 class="padding-bottom-10px">Prise de RDV</h3>

            <div id="small-ajax-div"></div>

            <p>
                <label for="datepicker" class="font-size-13px">Date* : </label>
                <input type="text" id="datepicker" name="dateposted" size="8" />
            </p>

            <p class="padding-bottom-10px">
                <label for="hourposted" class="font-size-13px">Créneau horaire* : </label>
                <select id="hourposted" name="hourposted">
                    <option value="8-10">8 à 10 h</option>
                    <option value="10-12">10 à 12 h</option>
                    <option value="14-16">14 à 16 h</option>
                    <option value="16-18">16 à 18 h</option>
                </select>
            </p>

            <p>
                <label for="addressposted" class="font-size-13px">Votre adresse* :</label>
                <br/><textarea id="addressposted" name="addressposted" rows="5" cols="27"></textarea>
            </p>

            <p>
                <label for="nameposted" class="font-size-13px">Votre nom* : </label>
                <input type="text" id="nameposted" name="nameposted" size="16"/>
            </p>

            <p class="padding-bottom-10px">
                <label for="emailposted" class="font-size-13px">Votre email* : </label>
                <input type="email" id="emailposted" name="emailposted" size="16" placeholder="exemple@mail.com"/>
            </p>

            <button id="rdv-confirm-btn" class="btn main-btn-style">ENVOYER</button>

        </div><!-- main-ajax-div -->

    </div><!-- text-align-center -->

</div>


<script>

    $( "#datepicker" ).datepicker(
    {
        // choix du format de date :
        dateFormat: 'dd-mm-yy',

        // Set the DatePicker so no weekend is selectable :
        beforeShowDay: $.datepicker.noWeekends
    });

</script>


<?php
// FOOTER :
include('footer.php');
?>