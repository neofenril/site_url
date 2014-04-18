<?php
require_once("config.inc.php");
class Url{
	private $id;
	private $source;
	private $courte;
	private $creation;
	private $auteur;
	
	
	public static function insertion($p, $source, $courte, $auteur=""){
		$creation=date('Y-m-d');
		$requete = $p->prepare("INSERT INTO urls (source, courte, creation, auteur)	VALUES(:source, :courte, :creation, :auteur)");
		$requete->bindParam('source', $source);
		$requete->bindParam('courte', $courte);
		$requete->bindParam('creation', $creation);
		$requete->bindParam('auteur', $auteur);
		$res = $requete->execute();
		
		return $res;
	}
	
	public static function courte_existe($p, $courte){
		$requete = $p->prepare("SELECT * FROM urls WHERE courte = :courte;");
		$requete->bindParam('courte', $courte);
		$requete->execute();
		$res = $requete->fetch(PDO::FETCH_OBJ);
		$compteur = $requete->rowCount();

		return $compteur;
	}
	
	
	public static function retour_url($p, $courte){
		$requete = $p->prepare("SELECT source FROM urls WHERE courte = :courte;");
		$requete->bindParam('courte', $courte);
		$requete->execute();
		$res = $requete->fetch(PDO::FETCH_OBJ);

		return $res->source;
	}
}
?>