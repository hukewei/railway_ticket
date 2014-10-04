<html>
	<head>
		<title>Liste de personne</title>
		<meta charset="utf-8">
		<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
		<link href="../client/css/style.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<table border="1">
			<tr>
				<td width="100pt"><b>Numero de Securité</b></td>
				<td width="100pt"><b>Nom</b></td>
				<td width="100pt"><b>Prénom</b></td>
				<td width="100pt"><b>Telephone</b></td>
				<?php
					$type_pers = $_REQUEST['type_pers'];
					if ($type_pers=='personnel_gare'){
						echo '<td width="100pt"><b>Fonction</b></td>';
					}
				?>
			</tr>
			<?php

				include "connect.php";
				$vConn = fConnect();
				$vSql ="select * from $type_pers";
				$vQuery=pg_query($vConn, $vSql);
				while($vResult=pg_fetch_array($vQuery)){
				echo "<tr>";
				echo "<td>$vResult[numsecu]</td>";
				echo "<td>$vResult[nom]</td>";
				echo "<td>$vResult[prenom]</td>";
				echo "<td>$vResult[telephone]</td>";
				if ($type_pers=='personnel_gare'){
						echo "<td>$vResult[typ]</td>";
					}
				echo "</tr>";
				}
				setcookie('type_pers',$type_pers);
		?>
		</table>
		<form action="change_mp_telephone.php" method="POST" class="login_label">
			<p>Quel Type de opération voulez vous effectuer?</p>
			<input type="radio" name="type" value="insert">Insert
			<input type="radio" name="type" value="update">Mise à jour
			<input type="radio" name="type" value="delete">Supprimer<br>
			Nom: <input type="text" name="nom" /><br/>
			Prénom: <input type="text" name="prenom" /><br/>
			Telephone: <input type="text" name="telephone" /><br/>
			Nouveau Telephone: <input type="text" name="nou_tele" /><br/>
			Numero de Sécurité: <input type="text" name="numsecu" /><br/>
			<?php
				if ($type_pers =='personnel_gare'){
					echo 'Fonction : <select name="typ"><option value ="Aiguilleur">Aiguilleur</option>';
					echo '<option value ="Guichetier">Guichetier</option>';
					echo '<option value ="Directeur">Directeur</option></select><br/>';
				}
			?>
			<input type="submit" value="valide">
		</form>
	</body>
</html>