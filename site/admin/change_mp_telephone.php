<?php
	$type = $_POST['type'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$telephone = $_POST['telephone'];
	$type_pers = $_COOKIE['type_pers'];
	include "connect.php";
	$vConn = fConnect();
	if($type =='update'){
		$nou_tele = $_POST['nou_tele'];
		$vSql = "UPDATE membre_personnel SET telephone = '$nou_tele' WHERE nom = '$nom' AND prenom = '$prenom' AND telephone = '$telephone'";
	}
	else if($type =='insert'){
		$numsecu = $_POST['numsecu'];
		$vSql = "INSERT INTO membre_personnel (numsecu,nom,prenom,telephone) VALUES ('$numsecu','$nom' ,'$prenom' ,'$telephone')";
		$vQuery=pg_query($vConn, $vSql);
		if($type_pers == 'conducteur'){
			$vSql = "INSERT INTO $type_pers (numsecu,nom,prenom,telephone) VALUES ('$numsecu','$nom' ,'$prenom' ,'$telephone')";
		}
		else{
			$typ = $_POST['typ'];
			$vSql = "INSERT INTO $type_pers (typ,numsecu,nom,prenom,telephone) VALUES ('$typ','$numsecu','$nom' ,'$prenom' ,'$telephone')";
		}
	}
	else if ($type =='delete'){
		$vSql = "DELETE FROM membre_personnel WHERE nom = '$nom' AND prenom = '$prenom' AND telephone = '$telephone'";
		//echo $vSql;
	}
	else{
		exit('bad');
	}
	$vQuery=pg_query($vConn, $vSql);	
	if($vQuery){
		echo $type." success!<br/>";
		$page_retour = "affiche_membre_pers.php?type_pers=".$type_pers;
		echo '<a href='.$page_retour.'>retourne à la page précedente :</a>';
	}
?>