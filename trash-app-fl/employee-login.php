<?php
// HEADER :
include('header.php');
?>


<div class="adapt-height padding-top-20px padding-bottom-20px">

    <div class="text-align-center">


		<?php
		// Si l'utilisateur n'a pas rentré les bonnes valeurs :
		// (et on récupère le message de non connexion)
		if (isset($_GET['get-msg']))
		{
			echo '<p class="italic">' . $_GET['get-msg'] . '</p>';
		}
		?>


		<h3>Connection :</h3>

		<div class="display-flex flex-direction-column align-items-center padding-bottom-5px"><!-- div form -->

			<form action="employee-login-process.php" method="post">

				<div class="width-200px padding-bottom-5px">
					<input type="text" name="employee-login" size="17" placeholder="Identifiant" required>
					<input type="password" name="employee-password" size="17" placeholder="Mot de passe" required>					
				</div>

				<input type="submit" value="VALIDER" class="btn default-btn-style">

			</form>

		</div><!-- div form -->

		<a href="index.php"><button class="btn default-btn-style">RETOUR</button></a>
	    	
    </div><!-- text-align-center -->

</div>


<?php
// FOOTER :
include('footer.php');
?>