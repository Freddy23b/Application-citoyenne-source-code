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


///// IV - ADD DU BULKYWASTE :

// On rentre les valeurs postées en variable :
$bwTypePost = $_POST['bwtype-posted'];
$bwLatPost = $_POST['bwlat-posted'];
$bwLngPost = $_POST['bwlng-posted'];
$bwAddressPost = $_POST['bwaddress-posted'];

// Si l'on a bien récupéré des valeurs via $_POST :
// (mettre la fonction "isset($variable)" et non "$variable", car sans cela, le booléen renvoit false pour la valeur 0)
if (isset($bwTypePost) AND isset($bwLatPost))
{
	// INSTANCE BULKYWASTE :
	// on renseigne les valeurs postées qui vont renseigner les ATTRIBUTS de l'OBJET bw :
	$bw = new BulkyWaste([
	    'type' => $bwTypePost,
	    'lat' => $bwLatPost,
	    'lng' => $bwLngPost,
	    'address' => $bwAddressPost,
	    'archives' => 0
	]);

	// INSERTION DANS LA DB du $bw via le manager :
	$bwManager->addBw($bw);

///// IV


	///// V - ENVOI DES DONNEES VERS JS :
	
	// On renvoit à JS le message de CONFIRMATION comportant les informations renseignées.
	// Ce message fait suite à "echo"
	// == "data" dans basics.js :
	echo 
	'<p class="padding-bottom-10px italic">
		L\'encombrant est enregistré.
		<br/>Merci !
	</p>

	<p class="font-size-13px underline">Récapitulatif :</p>
	
	<p class="padding-bottom-20px font-size-13px">

		Type : <span class="bold">' . $bwTypePost . '</span>
		<br/>Adresse indicative :
		<br/><span class="bold">' . $bwAddressPost . '</span>
		
	</p>

	<a href="index.php"><button class="btn main-btn-style">ACCUEIL</button></a>';
}
?>