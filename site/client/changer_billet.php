<html>
<head>
	<title>resultat d'achat</title>
	<meta charset="utf-8">
	<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
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
		<div id ='page'>
<?php
	$date_dep = $_COOKIE['date_dep'];
	$heure = $_COOKIE['heure'];
	$jour = $_COOKIE['jour'];
	$numero_itineraire = $_COOKIE['numero_itineraire'];
	$train = $_COOKIE['train'];
	$gare_depart = $_COOKIE['gare_depart'];
	$cp_depart = $_COOKIE['cp_depart'];
	$ville_depart = $_COOKIE['ville_depart'];
	$gare_arrivee = $_COOKIE['gare_arrivee'];
	$ville_arrivee = $_COOKIE['ville_arrivee'];
	$cp_arrivee = $_COOKIE['cp_arrivee'];
	$numbillet = $_COOKIE['billet'];
	include "connect.php";
	$vConn = fConnect();
	$vSql="UPDATE TrajetBillet SET Date_dep = '$date_dep',Heure='$heure',Jour='$jour',NumItineraire='$numero_itineraire',NumTrain='$train' WHERE Numero = '$numbillet'";
	$vQuery=pg_query($vConn, $vSql);
	if($vQuery){
		echo "Changement success!<br/>";
		$page_retour = "recherche.html";
		echo '<br/><a href='.$page_retour.'>retourne à la page précedente :</a>';
	}
?>
</div>
</body>
</html>