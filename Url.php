<?php
require_once("config.inc.php");
class Url{
	private $id;
	private $source;
	private $courte;
	private $creation;
	private $auteur;
	
	
	public static function insertion($p, $source, $courte, $auteur=""){
		$creation=date('d-m-Y')
		$requete = $p->prepare("INSERT INTO urls (source, courte, creation, auteur)	VALUES(:source, :courte, :creation, :auteur)");
		$requete->bindParam('nom', $source);
		$requete->bindParam('prenom', $courte);
		$requete->bindParam('pseudo', $creation);
		$requete->bindParam('mail', $auteur);
		$res = $requete->execute();
		
		return $res;
	}
	
	public static function courte_existe($p, $courte){
		$courte = '%' . $courte . '%';
		$requete = $p->prepare("SELECT * FROM urls WHERE courte LIKE :courte;");
		$requete->bindParam('courte', $courte);
		$requete->execute();
		$res = $requete->fetch(PDO::FETCH_OBJ);
		$compteur = $requete->rowCount();

		return $compteur;
	}