<html>
	<head>
		<title>Statistiques</title>
		<meta charset="utf-8">
		<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
        <link href="../client/css/style.css" rel="stylesheet" type="text/css" media="screen" />

	</head>
	<body>
		<h3>Taux de Remplissage</h3>
		<table border="1">
			<tr>
				<td width="100pt"><b>Date Depart</b></td>
				<td width="100pt"><b>Numero de train </b></td>
				<td width="100pt"><b>Taux de remplissage</b></td>
			</tr>
			<?php
				include "connect.php";
				$vConn = fConnect();
				$vSql ="SELECT date_dep,numero, round(cast(nb_reel as numeric)/cast(capacite as numeric),3) as taux from (select TB.date_dep,T.numero,TT.capacite,count(TB) as nb_reel from trains T, type_train TT,trajetbillet TB where T.typ = TT.typ AND T.numero = TB.numtrain group by TB.date_dep,T.numero,TT.capacite) as remp order by taux";
				$vQuery=pg_query($vConn, $vSql);
				while($vResult=pg_fetch_array($vQuery)){
				echo "<tr>";
				echo "<td>$vResult[date_dep]</td>";
				echo "<td>$vResult[numero]</td>";
				echo "<td>$vResult[taux]</td>";
				echo "</tr>";
				}
			?>
		</table>
		<h3>Sur Effectifs</h3>
		<table border="1">
			<tr>
				<td width="100pt"><b>Nom du Gare</b></td>
				<td width="100pt"><b>Sur effectif</b></td>
			</tr>
			<?php
				$vSql ="SELECT nomgare, nb_pers - min_emploi_tp  as sureffectif from (select G.nomgare, round(cast(sum(CT.type_contrat)as numeric)/2,1)  as nb_pers, G.min_emploi_tp from gares G, contrat_travail CT where G.nomgare = CT.Gare and G.cp = CT.cp and G.Ville = CT.ville group by G.nomgare,G.min_emploi_tp) as suref where nb_pers > min_emploi_tp order by sureffectif desc";
				$vQuery=pg_query($vConn, $vSql);
				while($vResult=pg_fetch_array($vQuery)){
				echo "<tr>";
				echo "<td>$vResult[nomgare]</td>";
				echo "<td>$vResult[sureffectif]</td>";
				echo "</tr>";
				}
			?>
		</table>
		<a href="./connexion.php">retournez à la page precedent</a>
	</body>
</html>