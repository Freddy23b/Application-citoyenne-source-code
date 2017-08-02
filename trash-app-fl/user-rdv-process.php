<?php
// CONNEXION DB :
include('connect-db.php');


// On rentre les valeurs postées en variable :
$datePost = $_POST['dateposted'];
$hourPost = $_POST['hourposted'];
$addressPost = $_POST['addressposted'];
$namePost = $_POST['nameposted'];
$emailPost = $_POST['emailposted'];


// VERIFICATION : que ce rdv n'est pas déjà pris :
// préparation :
$q = $db->prepare('SELECT id FROM ta_rdv WHERE rdvdate = :rdvdate AND rdvhour = :rdvhour');
// exécution :
$q->execute(array(
	'rdvdate'=>$datePost,
	'rdvhour'=>$hourPost
	));
// Je parcours ma requête :
$result = $q->fetch();


// TRAITEMENT : INSERTION en db ou MESSAGE à l'usager :
// > Si le rdv est déjà pris :
if ($result)
{
	$rdvMsg =
	'<p class="italic">
		Désolé,<br/>ce rdv est déjà pris !
	</p>
	
	<p class="padding-bottom-20px font-size-13px">
		(pour la date du : <span class="bold">' . $datePost . '</span>,
		<br/>avec le créneau : <span class="bold">' . $hourPost . ' h</span>)
	</p>

	<a href="user-rdv.php"><button class="btn main-btn-style">AUTRE RDV</button></a>';
}
// > Si le rdv n'est pas déjà pris :
else
{
	// INSERTION du rdv dans la DB :
	// libération du curseur pour la nouvelle requête qui va suivre :
	$q->closeCursor();
	// préparation :
	$q = $db->prepare('INSERT INTO ta_rdv(rdvdate, rdvhour, rdvaddress, rdvname, rdvemail, archives) VALUES(:rdvdate, :rdvhour, :rdvaddress, :rdvname, :rdvemail, :archives)');
	// exécution :
	$q->execute(array(
	    'rdvdate'=>$datePost,
	    'rdvhour'=>$hourPost,
	    'rdvaddress'=>$addressPost,
	    'rdvname'=>$namePost,
	    'rdvemail'=>$emailPost,
	    'archives'=>0
	    ));

	$rdvMsg =
	'<p class="italic">Votre rdv est bien enregistré.</p>
	
	<p class="font-size-13px underline">Récapitulatif :</p>

	<p class="padding-bottom-10px font-size-13px">
		
		Date : <span class="bold">' . $datePost . '</span>
		<br/>Créneau horaire : <span class="bold">' . $hourPost . ' h</span>
		<br/>Votre adresse :
		<br/><span class="bold">' . $addressPost . '</span>
		<br/>Votre nom : <span class="bold">' . $namePost . '</span>
		<br/>Votre email : <span class="bold">' . $emailPost . '</span>

	</p>

	<a href="index.php"><button class="btn main-btn-style">ACCUEIL</button></a>';
}


// On renvoit à JS le message spécifié.
// Ce message fait suite à "echo" (== "data" dans basics.js) :
echo $rdvMsg;
?>