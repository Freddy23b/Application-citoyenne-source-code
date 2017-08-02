<?php
///// I - CONNEXION DB

include('connect-db.php');


///// II -  CLASS LOAD

function classLoad($class)
{
	require $class . '.php';
}
spl_autoload_register('classLoad');


///// III - MANAGER INSTANCE

// on rentre la bonne DB en argument :
$bwManager = new BulkyWasteManager($db);


///// IV - UPDATE DU BULKYWASTE :

// On rentre les valeurs postées en variable :
$idBwClicked = $_POST['id-bw-clicked'];

// Si l'on a bien récupéré des valeurs via $_POST :
if (isset($idBwClicked))
{
	// INSTANCE BULKYWASTE :
	// on renseigne l'id sur lequel se portera l'update :
	$bw = new BulkyWaste([
	    'id' => $idBwClicked
	]);

	// UPDATE DANS LA DB du $bw via le manager :
	$bwManager->updateBw($bw);


	///// V - ENVOI DES DONNEES VERS JS :

	// On renvoit à JS le message de CONFIRMATION.
	// Ce message fait suite à "echo"
	// == "data" dans basics.js :
	echo 
	'<p class="italic padding-top-20px padding-bottom-10px">
		L\'encombrant cliqué est bien archivé.
		<br/>Merci de votre travail !
	</p>

	<a href="employee-mapbw.php"><button class="btn main-btn-style">AUTRE RETRAIT</button></a>

	<a href="index.php"><button class="btn main-btn-style">ACCUEIL</button></a>';
}
?>