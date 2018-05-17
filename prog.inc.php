<?php
class Employes{
	private $nom;
	private $jour;
	private $nbCafes;

	function __construct($nom,$jour,$nbCafes){
		$this->setNom($nom);
		$this->setJour($jour);
		$this->setNbCafes($nbCafes);
	}

	function getNom(){
	   return $this->nom;
	}
	function getJour(){
	   return $this->jour;
	}
	function getNbCafes(){
	   return $this->nbCafes;
	}

	function setNom($nom){
		$this->nom=$nom;
	}

	function setJour($jour){
		$this->jour=$jour;
	}
	
	function setNbCafes($nbCafes){
		$this->nbCafes=$nbCafes;
	}

	function afficher(){
	 $contenu="Nom : ".$this->nom;
	 $contenu.=". Jours : ".$this->jour;
	 $contenu.=". Cafe : ".$this->nbCafes."<br>";
	 return $contenu;
	}
	
}
?>