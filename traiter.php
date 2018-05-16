<link rel="stylesheet" href="css/monCSS.css">
<?php
function cafeText(){
	$fichier=fopen("programmeurs.txt","r");
	if ($fichier==null){
		echo "<br>Fichier introuvable";
		exit;
	}
	//echo "Taille du fichier = ".filesize("hospitalisations.txt");
	$entete=array();
	$ligne=fgets($fichier);
	$entete=explode(";",$ligne);
	$etat=1;
	while(!feof($fichier)){
		if ($etat==2){
			echo "<br><b>".$entete[0]."=</b>".strtok($ligne,";");
			$taille=count($entete);
			for($i=1;$i<$taille;$i++)
				echo "<br><b>".$entete[$i]."=</b>".strtok(";");
			echo "<br>***************************************";
		}
		else{
		   $etat=2;
		}
		$ligne=fgets($fichier);
	}
	fclose($fichier);
}
function listeHospitalisationsHTML(){
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

function listeHospitalisationsEtab($jours){
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

$action=$_POST['monAction'];
switch($action){
	case "obtenirListe" :
		listeHospitalisationsHTML();
	break;
	case "obtenirProgDay" :
	     $jours=$_POST['jours'];
		listeHospitalisationsEtab($jours);
	break;
}
echo "<br><br><a href=\"operations.html\">Retour a la page accueil</a>";
?>