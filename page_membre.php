<?php
require_once("tools.php");
require_once("config.inc.php");
require_once("Membre.php");
require_once("Url.php");

enteteTitreHTML("ConvertParadize");

	if (isset($_COOKIE["utilisateur"]))
{
	url();
	// ici on affiche toutes les données du membre
	finHTML();
}
	else 
		header('Location: index.php');