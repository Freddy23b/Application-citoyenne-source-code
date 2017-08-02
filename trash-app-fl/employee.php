<?php
// SECURITE :
// Récupération de la Session Start si elle a été ouverte
session_start();
// si l'utilisateur s'est connecté (et une Session Start a été ouverte) : on permet l'affichage du contenu :
if (isset($_SESSION['employee-login-session']) AND isset($_SESSION['employee-password-session']))
{ 


	// HEADER :
	include('header.php');
	?>


	<div class="adapt-height padding-top-20px">

	    <div class="text-align-center">
		
		    <!-- Choix : SIGNALEMENT ou DEMANDE ENLEVEMENT : -->
			<h3>Vous souhaitez<br/>consulter les...</h3>

		    <div class="display-flex justify-content-center">

				<div>
					<a href="employee-mapbw.php"><button class="btn main-btn-style">SIGNALEMENTS</button></a>
					<p class="font-size-13px">d'encombrants</p>
				</div>

				<div class="between-btn-margin"></div>

				<div>
					<a href="employee-rdv.php"><button class="btn main-btn-style">DEMANDES</button></a>
					<p class="font-size-13px">d'enlèvement<br/>d'encombrants</p>
				</div>

		    </div>

	    </div><!-- text-align-center -->

	</div>


	<?php
	// FOOTER :
	include('footer.php');


}
else
// SECURITE : si aucune session n'a été ouverte (tentative d'entrer sur la page sans être connecté) :
{
    echo '<p>Cette page est réservée aux employés connectés.</p>';
}
?>