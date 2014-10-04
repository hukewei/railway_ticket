<?php
	$type = $_POST['type'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$telephone = $_POST['telephone'];
	$numero = $_POST['numero'];
	include "connect.php";
	$vConn = fConnect();
	if($type =='update'){
		$nou_num = $_POST['nou_num'];
		$vSql = "SELECT * FROM trainconducteur WHERE nom = '$nom' AND prenom = '$prenom' AND telephone = '$telephone'";	
		$vQuery=pg_query($vConn, $vSql);
		$vResult=pg_fetch_array($vQuery);
		if($vResult[0] == null){
			$vSql = "INSERT INTO trainconducteur (nom,prenom,telephone,numero) VALUES ('$nom','$prenom','$telephone','$nou_num')";
		}
		else{
			$vSql = "UPDATE trainconducteur SET numero = '$nou_num' WHERE nom = '$nom' AND prenom = '$prenom' AND telephone = '$telephone' AND numero='$numero'";
		}

	}
	else if ($type =='delete'){
		$vSql = "DELETE FROM trainconducteur WHERE nom = '$nom' AND prenom = '$prenom' AND telephone = '$telephone' AND numero='$numero'";
		//echo $vSql;
	}
	else{
		exit('bad');
	}
	$vQuery=pg_query($vConn, $vSql);	
	if($vQuery){
		

		echo $type." success!<br/>";
		$page_retour = "affiche_train_conducteur.php";
		echo '<a href='.$page_retour.'>retourne à la page précedente :</a>';
	}
?>