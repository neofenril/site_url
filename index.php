<?php
include("tools.php");

enteteTitreHTML("ConvertParadize");

?>


<form method="get" action="film.php" name="url">
	<table style="left:10%;top:25%;width:40%;">
		<tr>
			<td>Votre URL :</td>
			<td><input type="text" name="raccourci" value="Entrez une URL"/></td>
			<td><input type="submit" value="Raccourcir" /></td>
		</tr>
	</table>
</form>

<form method="get" action="film.php" name="connexion">
	<table style="left:70%;top:25%;width:20%;">
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
</form>

<form method="get" action="inscription.php" name="enregistrement">
	<table style="left:70%;top:40%;width:20%;">
		<tr>
			<td><input type="submit" value="Inscription !" /></td>
		</tr>
	</table>
</form>



<?php 
finHTML();
?>
