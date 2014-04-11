<?php

require_once("tools.php");
require_once("config.inc.php");
require_once("Membre.php");

function genereFormulaireInscriptionMembre($message_erreur = "", $nom = "", $prenom = "", $pseudo = "", $mail = ""){
  // gestion des messages d'erreurs
  if ($message_erreur != "") {
    echo <<< MSG
    <div class="msgerreur2">
    $message_erreur
    </div>
MSG;
  }

  // formulaire d'inscription
  echo "<form method=\"post\" name=\"enreg\" action=\"" . $_SERVER['PHP_SELF'] . "\" onsubmit=\"return validation();\">";
  echo <<< YOP
              <table style="left:30%;top:25%;width:40%;">
		<tr>
			<td>Nom :</td>
			<td><input type="text" name="nom" value="$nom"></td>
		</tr>
		<tr>
			<td>Prénom :</td>
			<td><input type="text" name="prenom" value="$prenom"></td>
		</tr>
		<tr>
			<td>Pseudo :</td>
			<td><input type="text" name="pseudo" value="$pseudo"></td>
		</tr>
		<tr>
			<td>Adresse mail :</td>
			<td><input type="email" name="mail" value="$mail"></td>
		</tr>
		<tr>
			<td>Mot de passe :</td>
			<td><input type="password" name="password1"></td>
		</tr>
		</table>
		<input class="medskip" type="submit" value="Je crée mon compte !">
		<input type="hidden" name="fromform" value="true">
	</form>
YOP;
}



// ** traitements et vérifications des données saisies
function traiteFormulaire(){

  global $p;
	
  $nom = trim($_POST["nom"]);
  $prenom = trim($_POST["prenom"]);
  $pseudo = trim($_POST["pseudo"]);
  $mail = trim($_POST["mail"]);
  $password1 = trim($_POST["password1"]);
  $a_crypter = $password1;
  
	
  // *** Sécurité ***
	
  $nom = strip_tags(trim($nom));
  $prenom = strip_tags(trim($prenom));
  $pseudo = strip_tags(trim($pseudo));
  $mail = strip_tags(trim($mail));
  $password1 = strip_tags(trim($password1));
		
  
  /////////////////
  // Vérifications
  ////////////////
  
  $message_erreur = "";
  $erreur = false;
  
  // test si champs vides 
  
  if ($nom == "") {
    $message_erreur .= "Le nom ne peut être vide.<br>";
    $erreur = true;
  }
  
  if ($prenom == "") {
    $message_erreur .= "Le prénom ne peut être vide.<br>";
    $erreur = true;
  }
  
  if ($pseudo == "") {
    $message_erreur .= "Le pseudo ne peut être vide.<br>";
    $erreur = true;
  }
  
  if ($mail == "") {
    $message_erreur .= "L'adresse mail ne peut être vide.<br>";
    $erreur = true;
  }
  
  if ($password1 == "") {
    $message_erreur .= "Le mot de passe ne peut être vide.<br>";
    $erreur = true;
  }
  
  
  // test si pseudo existant 
  
  if ($pseudo != "") {
    $actuel = Membre::pseudo_existe($p, $pseudo);
    if ($actuel) {
      $message_erreur .= "Le pseudo est déjà pris !<br>";
      $erreur = true;
    }
  }
  
  /////////////////
  // Traitements...
  ////////////////
  
  if ($erreur){
    enteteTitreHTML("Inscription");
    echo '<div style="margin-top:25%;">';
    genereFormulaireInscriptionMembre($message_erreur, stripslashes($nom), stripslashes($prenom), stripslashes($pseudo), stripslashes($mail));
    echo "<br /><a href=\"index.php\">retour</a><br />";
    echo '</div>';
    echo '<br /><br /><br />';
    finHTML();
  }
  else{
    
    $res = $p->query("SELECT * FROM membres;");
    $profil = "utilisateur";
    
    // premier utilisateur > administrateur
    if (!($res->rowCount()))
      $profil = "administrateur";
    
    if ($res) {
      $mdp_crypte = sha1($a_crypter);
      $cree = Membre::insertion($p, $nom, $prenom, $pseudo, $mail, $mdp_crypte, $profil);
      
      if ($cree) {
	flash("Utilisateur ".stripslashes($pseudo)." ajouté !");
	header("Location: index.php");
      }
      
      else{
	flash("Problème d'enregistrement...");
	header("Location: index.php");
      }	
    }	  
  }
}




// ** Programme principal **

if (isset($_POST['fromform'])) {
  traiteFormulaire();
}
// affichage formulaire inscription
else {
  enteteTitreHTML("Inscription");
  echo '<div style="margin-top:25%;">';
  genereFormulaireInscriptionMembre();
  echo "<br /><a href=\"index.php\">retour</a><br />";
  echo '</div>';
  echo '<br /><br /><br />';
  finHTML();
}
?>
