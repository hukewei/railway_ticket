<html>
	<head>
		<title>Liste de Itineraire</title>
		<meta charset="utf-8">
		<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
        <link href="../client/css/style.css" rel="stylesheet" type="text/css" media="screen" />

	</head>
	<body>
		<table border="1">
			<tr>
				<td width="100pt"><b>Numero de Train</b></td>
				<td width="100pt"><b>Type de Train</b></td>
				<td width="100pt"><b>Heure depart</b></td>
				<td width="100pt"><b>Jour depart</b></td>
				<td width="100pt"><b>Numero d'itineraire</b></td>
			</tr>
			<?php
				include "connect.php";
				$vConn = fConnect();
				$vSql = "SELECT T.numero,typ,heure,jour,numitineraire from trains T left outer join itineraire_horaire IH on T.numero = IH.numtrain order by T.numero";
				$vQuery=pg_query($vConn, $vSql);
				while($vResult=pg_fetch_array($vQuery)){
				echo "<tr>";
				echo "<td>$vResult[numero]</td>";
				echo "<td>$vResult[typ]</td>";
				echo "<td>$vResult[heure]</td>";
				echo "<td>$vResult[jour]</td>";
				echo "<td>$vResult[numitineraire]</td>";
				echo "</tr>";
				}
			?>
		</table>
		<form action="change_itineraire_train.php" method="POST">
			<p>Quel Type de opération voulez vous effectuer?</p>
			<input type="radio" name="type" value="insert">Insert
			<input type="radio" name="type" value="update">Mise à jour
			<input type="radio" name="type" value="delete">Supprimer<br/>
			Numéro du train: <?php fListe_train("numtrain")?><br/>
			Heure depart: <input type="text" name="heure" /><br/>
			Jour avant <select name="jour">
				<option value="Lundi">Lundi</option>
				<option value="Mardi">Mardi</option>
				<option value="Mercredi">Mercredi</option>
				<option value="Jeudi">Jeudi</option>
				<option value="Vendredi">Vendredi</option>
				<option value="Samedi">Samedi</option>
				<option value="Dimanche">Dimanche</option>
			</select><br/>
			Numero de itineraire: <?php fListe_itineraire("numitineraire") ?><br/>
			<p>si vous voulez metre à jour:</p>
			Nouveau Heure depart: <input type="text" name="nou_heure" /><br/>
			Nouveau Jour <select name="nou_jour">
			<option value="Lundi">Lundi</option>
				<option value="Mardi">Mardi</option>
				<option value="Mercredi">Mercredi</option>
				<option value="Jeudi">Jeudi</option>
				<option value="Vendredi">Vendredi</option>
				<option value="Samedi">Samedi</option>
				<option value="Dimanche">Dimanche</option>
			</select><br/>
			<input type="submit" value="valide">
		</form>
	</body>
</html>