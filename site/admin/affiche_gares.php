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
				<td width="100pt"><b>Nom Gare</b></td>
				<td width="100pt"><b>Code Postal</b></td>
				<td width="100pt"><b>Min emploi du temps</b></td>
				<td width="100pt"><b>Ville</b></td>
				<td width="100pt"><b>Adresse</b></td>
			</tr>
			<?php
				include "connect.php";
				$vConn = fConnect();
				$vSql ="SELECT * FROM gares";
				$vQuery=pg_query($vConn, $vSql);
				while($vResult=pg_fetch_array($vQuery)){
				echo "<tr>";
				echo "<td>$vResult[nomgare]</td>";
				echo "<td>$vResult[cp]</td>";
				echo "<td>$vResult[min_emploi_tp]</td>";
				echo "<td>$vResult[ville]</td>";
				echo "<td>$vResult[adresse]</td>";
				echo "</tr>";
				}
			?>
		</table>
		<form action="change_min_emploi_tp.php" method="POST" class="login_label">
			<h3>Ajouter une nouvelle gare : </h3>
			Nom du Gare: <input type="text" name="nomgare" /><br/>
			Code Postal: <input type="text" name="cp" /><br/>
			Nom Ville: <input type="text" name="ville" /><br/>
			Min Emploi du temps: <input type="text" name="min_emploi_tp" /><br/>
			<input type="submit" value="valide">
		</form>
	</body>
</html>