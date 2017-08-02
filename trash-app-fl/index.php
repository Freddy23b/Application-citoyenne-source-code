<?php
// HEADER :
include('header.php');
?>


<!-- <div class="adapt-height padding-top-20px padding-bottom-20px vert-tilleul-bkgd"> -->
<div class="adapt-height padding-top-20px padding-bottom-20px">

    <div class="text-align-center">

		<!-- CHOIX : USAGER ou EMPLOYE -->
		<h3>Bienvenue !</h3>
		
		<p class="padding-bottom-10px">Vous êtes...</p>

		<div class="display-flex justify-content-center">

			<a href="user.php"><button class="btn main-btn-style">USAGER</button></a>

			<div class="between-btn-margin"></div>

	    	<a href="employee-login.php"><button class="btn main-btn-style">EMPLOYE DE<br/>MAIRIE</button></a>
	    	
		</div>

    </div><!-- text-align-center -->

</div>


<?php
// FOOTER :
include('footer.php');
?>