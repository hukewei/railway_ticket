<?php
	$type = $_POST['type'];
	$numtrain = $_POST['numtrain'];
	$numitineraire = $_POST['numitineraire'];
	$heure = $_POST['heure'];
	$nou_heure = $_POST['nou_heure'];
	$jour = $_POST['jour'];
	$nou_jour = $_POST['nou_jour'];
	include "connect.php";
	$vConn = fConnect();
	if($type =='update'){
		$vSql = "UPDATE itineraire_horaire SET heure = '$nou_heure',jour='$nou_jour' WHERE heure = '$heure' AND jour = '$jour' AND numitineraire = '$numitineraire' AND numtrain='$numtrain'";
	}
	else if ($type =='delete'){
		$vSql = "DELETE FROM itineraire_horaire WHERE heure = '$heure' AND jour = '$jour' AND numitineraire = '$numitineraire' AND numtrain='$numtrain'";
	}
	else if ($type =='insert'){
		$vSql = "INSERT INTO itineraire_horaire (numtrain,numitineraire,heure,jour) VALUES ('$numtrain','$numitineraire','$heure','$jour')";
	}
	else{
		exit('bad');
	}
	$vQuery=pg_query($vConn, $vSql);	
	if($vQuery){
		

		echo $type." success!<br/>";
		$page_retour = "affiche_itineraire_train.php";
		echo '<a href='.$page_retour.'>retourne à la page précedente :</a>';
	}
?>