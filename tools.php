<?php

session_start();

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
					<td><input type="password" name="mdp"/></td>
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
			<form method="post" action="index.php" name="url">
				<table style="left:10%;top:50%;width:40%;font-size:2em;">
					<tr>
						<td><h2>Votre URL :</h2></td>
						<td><input type="text" name="rac" /></td>
						<td><input type="submit" value="Raccourcir" /></td>
					</tr>
				</table>
				<input type="hidden" name="raccourci" value="true">
			</form>
END;
}


function traiteConnexion(){
	
	global $p;
	
	$message_erreur = "";
	$erreur = false;

	$pseudo = trim($_POST["pseudo"]);
	$password1 = trim($_POST["mdp"]);
	$_SESSION['pseudo']= $pseudo;
	$_SESSION['mdp']=$password1;

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
	$expiration = 60 * 60 * 24 * 15;

//expiration du cookie initialisée cette fois a 30 secondes
//$expiration = 30;


if (isset($_COOKIE['utilisateur']))
{
	$pseudo = $_COOKIE['utilisateur'];
	$mdp = $_COOKIE['mdp'];
	}
else {
	$pseudo = $_SESSION['pseudo'];
	$mdp = $_SESSION['mdp'];
	}
setcookie('utilisateur' , $pseudo ,
	time() +$expiration);
setcookie('mdp' , $mdp , 
	time() +$expiration);
}
function traiteConnexionCook(){
	
	global $p;

	$pseudo = $_SESSION["pseudo1"];
	$password1 = $_SESSION["mdp1"];

	$pseudo = strip_tags(trim($pseudo));
	$password1 = strip_tags(trim($password1));

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



function traiteURL(){
	$message = "";
	$erreur = false;
	
	$url = trim($_POST["rac"]);
	$code = $url;
	$url = strip_tags(trim($url));
	
	$courte = "http://www.ConPar.com/";
	
	if ($url == "") {
		$message .= "Entrez une URL.<br>";
		$erreur = true;
	}
 
	if ($erreur){
		connecte();
		echo <<< MSG
			<div class="msgerreur2">
				$message
			</div>
MSG;
	}else{	
		$code = sha1($code);
		$min = rand (0, 35);
		$code = substr($code, $min, 5);
		$courte .= $code;
		echo <<< END
			<form method="post" action="index.php" name="url">
				<table style="left:10%;top:70%;width:40%;font-size:2em;">
					<tr>
						<td><br /><a href=$url>$courte</a><br /></td>
					</tr>
				</table>
			</form>
END;

	}
}




function enteteHTML($titre)
{
  echo <<< YOP
  <!DOCTYPE html> 
  <html>
    <head>
      <meta charset="utf-8" />
      <link href="style.css" media="screen" rel="stylesheet" type="text/css">
      <title>
        $titre
      </title>
    </head>
    <body>
YOP;

  if (isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    echo <<< MSG
  
  <div class="msginfo">
    $info
  </div>
MSG;
  unset($_SESSION['info']);
  }
}

function enteteTitreHTML($titre)
{
  enteteHTML($titre);
  echo <<< YOP

    <h1>
      $titre
    </h1>
YOP;
}

function finHTML()
{
  echo <<< YOP

  </body>
</html>
YOP;
}

function flash($texte)
{
  $_SESSION['info'] .= $texte;
}

?>
