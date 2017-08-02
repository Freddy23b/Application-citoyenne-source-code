<?php
///// I - CONNEXION DB

include('connect-db.php');


///// II - UPDATE DU RDV :

// On rentre les valeurs postées en variable :
$idRdvClicked = $_POST['id-rdv-clicked'];

// Si l'on a bien récupéré des valeurs via $_POST :
if (isset($idRdvClicked))
{
	// préparation :
	$q = $db->prepare('UPDATE ta_rdv SET archives = :archives WHERE id = :id');// update sur la bouteille ciblée (id)
	// exécution :
	$q->execute(array(
	    'archives'=>1,
		'id'=>$idRdvClicked
		));


	///// V - ENVOI DES DONNEES VERS JS :

	// On renvoit à JS le message de CONFIRMATION.
	// Ce message fait suite à "echo"
	// == "data" dans basics.js :
	echo 
	'<p class="italic padding-top-20px padding-bottom-10px">
		Le RDV sélectionné est bien archivé.
		<br/>Merci de votre travail !
	</p>

	<a href="employee-rdv.php"><button class="btn main-btn-style">AUTRE RDV</button></a>

	<a href="index.php"><button class="btn main-btn-style">ACCUEIL</button></a>';
}
?>