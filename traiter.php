
<?php
require_once("prog.inc.php");
//******************* Début du programme **********************************
$tabProg=array();
$fic=fopen("programmeurs.txt","r");
$ligne=fgets($fic);
while (!feof($fic)){
	$nom=strtok($ligne,";");
	$jour=strtok(";");
	$nbCafes=strtok(";");
	$tabProg[]= new Employes($nom,$jour,$nbCafes);
	$ligne=fgets($fic);
}

function afficherTableau(){
global $tabProg;
$taille=count($tabProg);
for($i=0;$i<$taille;$i++)
    echo $tabProg[$i]->afficher();
}

function listeProg(){
	$fichier=fopen("programmeurs.txt","r");
	if ($fichier==null){
		echo "<br>Fichier introuvable";
		exit;
	}
	//echo "Taille du fichier = ".filesize("hospitalisations.txt");
	$entete=array();
	$ligne=fgets($fichier);
	$entete=explode(";",$ligne);
	echo "<table border=1>";
	echo "<caption>Liste des Programmeurs</caption>";
	echo "<thead><tr>";
	$taille=count($entete);
	echo "<th>Programmeurs</th><th>Jour de la semaine</th><th>Nombres de cafes</th>";
	echo "</tr></thead>";
	$etat=2;
	while(!feof($fichier)){
		if ($etat==2){
		    echo "<tr>";
			$elem=strtok($ligne,";");
			while($elem!==false){
				echo "<td>".$elem."</td>";
				$elem=strtok(";");
			}
			echo "</tr>";
		}
		else{
		   $etat=2;
		}
		$ligne=fgets($fichier);
	}
	echo "</table>";
	fclose($fichier);
}

function moyCafe($jours){
	global $tabProg;
	$taille=count($tabProg);
	$counta = 0;
	$countaC = 0;
	for($i=0;$i<$taille;$i++){
		if($tabProg[$i]->getJour() == $jours){
			$countaC += $tabProg[$i]->getNbCafes();
			$counta++;
		}
	}
	$moyenne = $countaC / $counta;
	echo "<h1>Moyenne de cafe consomme pour le ".$jours." :</h1>";
	echo $moyenne;
}
function calcBuveur(){
	global $tabProg;
	$taille=count($tabProg);
	$whois = -1;
	$countaM = 0;
	$counta = 0;
	for($i=0;$i<$taille;$i++){
		$counta = $tabProg[$i]->getNbCafes();
		for($j=$i+1;$j<$taille;$j++){
			if($tabProg[$i]->getNom() == $tabProg[$j]->getNom()){
				$counta += $tabProg[$j]->getNbCafes();
			}
		}
		if($counta > $countaM){
			$countaM = $counta;
			$whois = $i;
		}
}
echo "<h1>Le plus grand buveur de cafe</h1>";
echo "La personne qui a bu le plus de cafe dans la semaine est : ".$tabProg[$whois]->getNom()." avec ".$countaM." cafes.";
}
function nombreCafe($pers){
	global $tabProg;
	$taille=count($tabProg);
	$countaC = 0;
	for($i=0;$i<$taille;$i++){
		if($tabProg[$i]->getNom() === $pers)
			$countaC += $tabProg[$i]->getNbCafes();
	}
	echo "<h1>".$pers." a bu : ".$countaC." cafes</h1>";
}
function listeConsoCafe($jours){
	$fichier=fopen("programmeurs.txt","r");
	if ($fichier==null){
		echo "<br>Fichier introuvable";
		exit;
	}
	//echo "Taille du fichier = ".filesize("hospitalisations.txt");
	$entete=array();
	$ligne=fgets($fichier);
	// $taille=count($entete);
	// for($i=0;$i<$taille;$i++)
	// 	echo "<th>".$entete[$i]."</th>";
	// echo "</tr></thead>";
	echo "<h1>Les programmeurs qui ont consommer du cafe le ".$jours." sont :</h1>";
	echo "<ul>";
	while(!feof($fichier)){  
			$entete=explode(";",$ligne);
			if ($entete[1]==$jours){
				echo "<li>".$entete[0]."</li>";
			}
		$ligne=fgets($fichier);
	}
	echo "</ul>";
	fclose($fichier);
}
function maxCafeD(){
	global $tabProg;
	$taille=count($tabProg);
	$whois = -1;
	$countaM = 0;
	$counta = 0;
	for($i=0;$i<$taille;$i++){
		$counta = $tabProg[$i]->getNbCafes();
		for($j=0;$j<$taille;$j++){
			if($tabProg[$i]->getJour() == $tabProg[$j]->getJour() && $tabProg[$i] != $tabProg[$j]){
				$counta += $tabProg[$j]->getNbCafes();
			}
		}
		if($counta > $countaM){
			$countaM = $counta;
			$whois = $i;
		}
}
echo "<h1>Le jour ou le plus de cafe sont bu est le : ".$tabProg[$whois]->getJour()." avec ".$countaM." cafes.</h1>";
}

$action=$_POST['monAction'];
switch($action){
	case "obtenirListe" :
		listeProg();
	break;
	case "obtenirProgDay" :
	     $jours=$_POST['jours'];
		listeConsoCafe($jours);
	break;
	case "maxCafe" :
		calcBuveur();
	break;
	case "cafeMoy" :
	    $jours2=$_POST['jours2'];
		moyCafe($jours2);
	break;
	case "persCafe" :
		$pers=$_POST['personne'];
		nombreCafe($pers);
	break;
	case "maxCafeD" :
		maxCafeD();
	break;
}
echo "<br><br><a href=\"operations.html\">Retour a la page accueil</a>";
?>