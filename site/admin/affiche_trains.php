<html>
	<head>
		<title>Liste de Train</title>
		<meta charset="utf-8">
		<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
        <link href="../client/css/style.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<table border="1">
			<tr>
				<td width="100pt"><b>Numero de Train</b></td>
				<td width="100pt"><b>Type de Train</b></td>
				<td width="100pt"><b>Nombre de Conducteur</b></td>
			</tr>
			<?php
				include "connect.php";
				$vConn = fConnect();
				$vSql = "SELECT T.numero, typ,count(nom) as nb_conducteur from trains T LEFT OUTER JOIN trainconducteur TC ON T.numero = TC.numero group by typ,T.numero order by T.numero";
				$vQuery=pg_query($vConn, $vSql);
				while($vResult=pg_fetch_array($vQuery)){
				echo "<tr>";
				echo "<td>$vResult[numero]</td>";
				echo "<td>$vResult[typ]</td>";
				echo "<td>$vResult[nb_conducteur]</td>";
				echo "</tr>";
				}
			?>
		</table>
		<form action="change_train.php" method="POST">
			<p>Quel Type de opération voulez vous effectuer?</p>
			<input type="radio" name="type" value="insert">Insert
			<input type="radio" name="type" value="update">Mise à jour
			<input type="radio" name="type" value="delete">Supprimer<br>
			Numéro du train: <input type="text" name="numero" /><br/>
			Type <select name="typ">
				<option value="TER">TER</option>
				<option value="TGV">TGV</option>
				<option value="INTER">INTER CITÉ</option>
			</select><br/>
			<input type="submit" value="valide">
		</form>
	</body>
</html>