<?php
// HEADER :
include('header.php');
?>


<div class="adapt-height padding-top-20px">

    <div class="text-align-center">
	
	    <!-- Choix : SIGNALEMENT ou DEMANDE ENLEVEMENT : -->
		<h3>Vous souhaitez...</h3>

	    <div class="display-flex justify-content-center">

			<div>
				<a href="user-type.php"><button class="btn main-btn-style">SIGNALER</button></a>
				<p class="font-size-13px">un encombrant</p>
			</div>

			<div class="between-btn-margin"></div>

			<div>
				<a href="user-rdv.php"><button class="btn main-btn-style">DEMANDER</button></a>
				<p class="font-size-13px">l'enlèvement d'un<br/>encombrant<br/>(prise de RDV)</p>
			</div>

	    </div>

    </div><!-- text-align-center -->

</div>


<?php
// FOOTER :
include('footer.php');
?>