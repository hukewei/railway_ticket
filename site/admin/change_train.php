<?php
	$type = $_POST['type'];
	$numero = $_POST['numero'];
	$typ = $_POST['typ'];
	include "connect.php";
	$vConn = fConnect();
	if($type =='update'){
		$vSql = "UPDATE trains SET typ = '$typ' WHERE numero='$numero'";
	}
	else if ($type =='delete'){
		$vSql = "DELETE FROM trains WHERE numero='$numero'";
	}
	else if ($type =='insert'){
		$vSql = "INSERT INTO trains (numero,typ) VALUES ('$numero','$typ')";
	}
	else{
		exit('bad');
	}
	$vQuery=pg_query($vConn, $vSql);	
	if($vQuery){
		echo $type." success!<br/>";
		$page_retour = "affiche_trains.php";
		echo '<a href='.$page_retour.'>retourne à la page précedente :</a>';
	}
?>