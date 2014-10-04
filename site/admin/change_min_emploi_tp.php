<?php
	$nomgare = $_POST['nomgare'];
	$cp = $_POST['cp'];
	$ville = $_POST['ville'];
	$min_emploi_tp = $_POST['min_emploi_tp'];
	include "connect.php";
	$vConn = fConnect();
	$vSql = "UPDATE gares SET min_emploi_tp = $min_emploi_tp WHERE nomgare = '$nomgare' AND cp = '$cp' AND ville = '$ville'";
	$vQuery=pg_query($vConn, $vSql);
	if($vQuery){
		echo "success!<br/>";
		echo '<a href="affiche_gares.php">retourne à la page précedente :</a>';
	}
?>