<html>
	<head>
	<meta charset="utf-8">
	<title>Gérer votre billets</title>
	<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script type="text/javascript">
    function gerer(num) {
    	var x=document.getElementById(num);
    	var billet = $(x).find("#numero").html();
        var itineraire = $(x).find("#numitineraire").html();
        var date_dep = $(x).find("#date_dep").html();
        var heure = $(x).find("#heure").html();
        var jour = $(x).find("#jour").html();
        var gare_depart = $(x).find("#gare_depart").html();
        var cp_depart = $(x).find("#cp_depart").html();
        var ville_depart = $(x).find("#ville_depart").html();
        var gare_arrivee = $(x).find("#gare_arrivee").html();
        var ville_arrivee = $(x).find("#ville_arrivee").html();
        var cp_arrivee = $(x).find("#cp_arrivee").html();
        var assurance = $(x).find("#assurance").html();
        var nom = $(document).find("#nom").html();
        var prenom = $(document).find("#prenom").html();
        var telephone = $(document).find("#telephone").html();
        $.cookie("numitineraire", itineraire);
        $.cookie("date_dep", date_dep);
        $.cookie("heure", heure);
        $.cookie("nom", nom);
        $.cookie("prenom", prenom);
        $.cookie("telephone", telephone);
        $.cookie("jour", jour);
        $.cookie("billet", billet);
        $.cookie("gare_depart", gare_depart);
        $.cookie("cp_depart", cp_depart);
        $.cookie("ville_depart", ville_depart);
        $.cookie("gare_arrivee", gare_arrivee);
        $.cookie("ville_arrivee", ville_arrivee);
        $.cookie("cp_arrivee", cp_arrivee);
        $.cookie("assurance", assurance);




        location.href = "modifier.html";
    }
    </script>
	</head>
	<body>
		<div id="wrapper">
	<div id="menu-wrapper">
		<div id="menu" class="container">
			<ul>
				<li class="current_page_item"><a href="index.html">Homepage</a></li>
				<li><a href="recherche.html">Rechercher un trajet</a></li>
				<li><a href="gerer_billets.html">Gérer vos billets</a></li>
			</ul>
		</div>
	</div>
	<div id="page">
		<p>Votre information personnel :</p>
		<table border="1">
			<tr>
				<td width="100pt"><b>Nom</b></td>
				<td width="100pt"><b>Prénom</b></td>
				<td width="100pt"><b>Telephone</b></td>
			</tr>

<?php
	if(!isset($_POST['nom'])){
		$nom =$_COOKIE['nom'];
	}
	else{
		$nom = $_POST['nom'];
	}
	if(!isset($_POST['prenom'])){
		$prenom =$_COOKIE['prenom'];
	}
	else{
		$prenom = $_POST['prenom'];
	}
	if(!isset($_POST['telephone'])){
		$telephone =$_COOKIE['telephone'];
	}
	else{
		$telephone = $_POST['telephone'];
	}
	include "connect.php";
	$vConn = fConnect();
	echo "<tr>";
				echo "<td id='nom'>$nom</td>";
				echo "<td id='prenom'>$prenom</td>";
				echo "<td id='telephone'>$telephone</td>";
	echo "</tr></table>";
?>
<p>Votre information de trajet :</p>
<table border="1" >
			<tr>
				<td width="100pt"><b>Numero de Billet</b></td>	
				<td width="100pt"><b>Date depart</b></td>
				<td width="100pt"><b>Heure depart</b></td>
				<td width="100pt"><b>Jour</b></td>
				<td width="100pt"><b>Numero de itineraire</b></td>
				<td width="100pt"><b>Ville depart</b></td>
				<td width="100pt"><b>Gare depart</b></td>
				<td width="100pt"><b>CP depart</b></td>
				<td width="100pt"><b>Ville arrivee</b></td>
				<td width="100pt"><b>Gare Arrivee</b></td>
				<td width="100pt"><b>CP arrivee</b></td>
				<td width="100pt"><b>Assurance</b></td>	
				<td width="100pt"><b>Gerer</b></td>
			</tr>
<?php
	$vSql = "SELECT * from billets B, trajetbillet TB where  b.status = 'V' and b.nom = '$nom' and b.prenom = '$prenom' and b.telephone = '$telephone' and B.numero = TB.numero";
	$vQuery=pg_query($vConn, $vSql);
	$i = 0;
	while($vResult=pg_fetch_array($vQuery)){
	echo "<tr id='$i'>";
		echo "<td id = 'numero'>$vResult[numero]</td>";
		echo "<td id = 'date_dep'>$vResult[date_dep]</td>";
		echo "<td id = 'heure'>$vResult[heure]</td>";
		echo "<td id = 'jour'>$vResult[jour]</td>";
		echo "<td id = 'numitineraire'>$vResult[numitineraire]</td>";
		echo "<td id = 'ville_depart'>$vResult[villedepart]</td>";
		echo "<td id = 'gare_depart'>$vResult[garedeparttrajet]</td>";
		echo "<td id = 'cp_depart'>$vResult[cpdepart]</td>";
		echo "<td id = 'ville_arrivee'>$vResult[villearrivee]</td>";
		echo "<td id = 'gare_arrivee'>$vResult[garearriveetrajet]</td>";						
		echo "<td id = 'cp_arrivee'>$vResult[cparrivee]</td>";
		echo "<td id = 'assurance'>$vResult[assurance]</td>";
		echo "<td ><button type='button' onclick = 'gerer($i);'>Gerer ce billet</button></td>";
	echo "</tr>";
	$i++;
	}
	?>
	</table>
	<p/>
</div>
</body>
</HTML>