<html>
	<head>
		<title>Liste de Gares</title>
		<meta charset="utf-8">
		<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
		<link href="../client/css/style.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<table border="1">
			<tr>
				<td width="100pt"><b>Numero de Train</b></td>
				<td width="100pt"><b>Nom du conducteur</b></td>
				<td width="100pt"><b>Prenom</b></td>
				<td width="100pt"><b>Telephone</b></td>
			</tr>
			<?php
				include "connect.php";
				$vConn = fConnect();
				$vSql ="select C.nom, C.prenom,C.telephone,TC.numero from conducteur C LEFT OUTER JOIN trainconducteur TC ON (C.nom = TC.nom)";
				$vQuery=pg_query($vConn, $vSql);
				while($vResult=pg_fetch_array($vQuery)){
				echo "<tr>";
				echo "<td>$vResult[numero]</td>";
				echo "<td>$vResult[nom]</td>";
				echo "<td>$vResult[prenom]</td>";
				echo "<td>$vResult[telephone]</td>";
				echo "</tr>";
				}
			?>
		</table>
		<form action="change_train_conducteur.php" method="POST" class="login_label">
			<p>Quel Type de opération voulez vous effectuer?</p>
			<input type="radio" name="type" value="update">Mise à jour
			<input type="radio" name="type" value="delete">Supprimer<br>
			Nom: <input type="text" name="nom" /><br/>
			Prénom: <input type="text" name="prenom" /><br/>
			Telephone: <input type="text" name="telephone" /><br/>
			Numero de Trains: <?php $Liste_train = fListe_train('numero'); ?><br/>
			Nouveau Num de Trains: <?php $Liste_train = fListe_train('nou_num'); ?><br/>
			<input type="submit" value="valide">
		</form>
	</body>
</html>