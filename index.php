<?php
require_once("tools.php");
require_once("config.inc.php");
require_once("Membre.php");

enteteTitreHTML("ConvertParadize");

function connecte(){
	echo "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\" name=\"connexion\">";
	echo <<< END
			<table style="left:70%;top:45%;width:20%;">
				<tr>
					<td>Pseudo :</td>
				</tr>
				<tr>
					<td><input type="text" name="pseudo"/></td>
				</tr>
				<tr>
					<td>Mot de Passe :</td>
				</tr>
				<tr>
					<td><input type="text" name="mdp"/></td>
				</tr>
				<tr>
					<td><input type="submit" value="Connexion !" /></td>
				</tr>
			</table>
			<input type="hidden" name="connecter" value="true">
		</form>

		<form method="get" action="inscription.php" name="enregistrement">
			<table style="left:70%;top:60%;width:20%;">
				<tr>
					<td><input type="submit" value="Inscription !" /></td>
				</tr>
			</table>
		</form>
END;
}

function url(){

	echo <<< END
			<form method="get" action="film.php" name="url">
				<table style="left:10%;top:50%;width:40%;font-size:2em;">
					<tr>
						<td><h2>Votre URL :</h2></td>
						<td><input type="text" name="raccourci" value="Entrez une URL"/></td>
						<td><input type="submit" value="Raccourcir" /></td>
					</tr>
				</table>
			</form>
END;
}


function traiteConnexion(){
	global $p;
	
	$message_erreur = "";
	$erreur = false;

	$pseudo = trim($_POST["pseudo"]);
	$password1 = trim($_POST["mdp"]);

	$pseudo = strip_tags(trim($pseudo));
	$password1 = strip_tags(trim($password1));

	if ($pseudo == "") {
		$message_erreur .= "Le pseudo ne peut être vide.<br>";
		$erreur = true;
	 }
  
	if ($password1 == "") {
		$message_erreur .= "Le mot de passe ne peut être vide.<br>";
		$erreur = true;
	}
  
	if ($pseudo != "") {
		$actuel = Membre::pseudo_existe($p, $pseudo);
		if (!$actuel) {
			$message_erreur .= "Le pseudo n'existe pas!<br>";
			$erreur = true;
		}
	}
	if ($erreur){
		connecte();
		echo <<< MSG
			<div class="msgerreur2">
				$message_erreur
			</div>
MSG;
	}else{	
		echo <<< END
			<div class="div" style="left:55%;top:45%;width:40%;">
				<h2>Vos URL Deja Raccourcies</h2>
				<table>
					<tr>
						<td>URL Longue</td>
						<td>Raccourci</td>
						<td>Date</td>
					</tr>
				</table>
			</div>
END;
	}
}


url();
if (isset($_POST['connecter'])) {
	traiteConnexion();
}
else {
	connecte();
}
finHTML();
?>
