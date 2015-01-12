<?php

class PDOConfig extends PDO {
	private $engine;
	private $hote;
	private $basededonnee;
	private $utilisateur;
	private $motdepasse;

	public function __construct(){
		$this->engine = 'mysql';
		$this->hote = 'localhost';
		$this->basededonnee = 'tpWeb';
		$this->utilisateur = 'root';
		$this->motdepasse = '3112';
		$dns = $this->engine.':dbname='.$this->basededonnee.";host=".$this->hote;
		parent::__construct( $dns, $this->utilisateur, $this->motdepasse );
	}
}

?>