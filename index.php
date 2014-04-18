<?php
require_once("tools.php");
require_once("config.inc.php");
require_once("Membre.php");
require_once("Url.php");

enteteTitreHTML("ConvertParadize");
<<<<<<< HEAD



if (isset($_COOKIE["utilisateur"]))
{

	echo "Connecté";
	url();
	$_SESSION["pseudo1"] = $_COOKIE["utilisateur"];
	$_SESSION["mdp1"] = $_COOKIE["mdp"];
	traiteConnexionCook();
	
}
else
{
	url();
	if (isset($_POST['connecter'])) {
		traiteConnexion();
	}
	else {
		connecte();
		if (isset($_POST['raccourci'])) {
			traiteURL();
		}
	}
}
finHTML();
=======
getURL();
>>>>>>> 73da19dfaba9b6198878982ebf1de6bafc80f626
?>
