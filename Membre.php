<?php
require_once("config.inc.php");
class Membre{
	private $id;
	private $nom;
	private $prenom;
	private $pseudo;
	private $mail;
	private $mdp;
	private $profil;
	
	public function __construct(){
	
	
	}
	
	public static function insertion($p, $nom, $prenom, $pseudo, $mail, $mdp, $profil){
		$requete = $p->prepare("INSERT INTO membres (nom, prenom, pseudo, mail, mdp, profil)	VALUES(:nom, :prenom, :pseudo, :mail, :mdp, :profil)");
		$requete->bindParam('nom', $nom);
		$requete->bindParam('prenom', $prenom);
		$requete->bindParam('pseudo', $pseudo);
		$requete->bindParam('mail', $mail);
		$requete->bindParam('mdp', $mdp);
		$requete->bindParam('profil', $profil);
		$res = $requete->execute();
		
		return $res;
	}
	
	public static function pseudo_existe($p, $pseudo){
		$requete = $p->prepare("SELECT * FROM membres WHERE pseudo = :pseudo;");
		$requete->bindParam('pseudo', $pseudo);
		$requete->execute();
		$res = $requete->fetch(PDO::FETCH_OBJ);
		$compteur = $requete->rowCount();

		return $compteur;
	}
	
	public static function pass_existe($p, $pseudo){
		$requete = $p->prepare("SELECT mdp FROM membres WHERE pseudo = :pseudo;");
		$requete->bindParam('pseudo', $pseudo);
		$requete->execute();
		$res = $requete->fetch(PDO::FETCH_OBJ);

		return $res->mdp;
	}
	
	
	 

	public static function est_admin($p, $pseudo){
		$requete = $p->prepare("SELECT profil FROM membres WHERE pseudo = :pseudo;");
		$requete->bindParam('pseudo', $pseudo);
		$requete->execute();
		$res = $requete->fetch(PDO::FETCH_OBJ);
		
		return $res->profil;
	}
}
?>