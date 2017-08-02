<?php
// Je récupère en variable :

// 1 - Mon login :
$employeeLogin = $_POST['employee-login'];
// affichage debug :
var_dump($employeeLogin);

// 2 - Mon password "haché" :
$employeePassword = $_POST['employee-password'];
// affichage debug :
var_dump($employeePassword);

// Si l'on a rentré les bonnes valeurs :
if ($employeeLogin === 'admin' && $employeePassword === 'admin')
{
	// On ouvre une session start pour que l'utilisateur ait toujours sa connexion :
	session_start();
	// on insère dans cette session :
	// 1 - le login posté :
	$_SESSION['employee-login-session'] = $employeeLogin;
	// 2 - le password posté :
	$_SESSION['employee-password-session'] = $employeePassword;

	// On dirige vers la page "employee"
	header('Location: employee.php');
}
// Si l'on a pas rentré les bonnes valeurs :
else
{
	header('Location: employee-login.php?get-msg=Compte employé non reconnu');
}
?>