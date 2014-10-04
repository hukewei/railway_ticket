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
					<li class="current_page_item"><a href="./">Homepage</a></li>
					<li><a href="recherche.html">Rechercher un trajet</a></li>
					<li><a href="gerer_billets.html">Gérer vos billets</a></li>
				</ul>
			</div>
		</div>
		<div id ='page'>
<?php
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$telephone = $_POST['telephone'];
	$assu = $_POST['assu'];
	$paiement = $_POST['paiement'];
	$mode = $_POST['mode'];
	$type_pers = $_POST['mode'];
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
	include "connect.php";
	$vConn = fConnect();
	$vSql="INSERT INTO Billets (Numero,Assurance,Moyen_paiement,Mode_Achat,Nom,Prenom,Telephone,status) VALUES (nextval('serial_num_billet'),'$assu','$paiement','$mode','$nom','$prenom','$telephone','V')";
	$vQuery=pg_query($vConn, $vSql);	
	$vSql="INSERT INTO TrajetBillet (Date_dep,Heure,Jour,NumItineraire,NumTrain,GareDepartTrajet,CPDepart,VilleDepart,GareArriveeTrajet,VilleArrivee,CPArrivee,Numero) 
	VALUES('$date_dep','$heure','$jour','$numero_itineraire','$train','$gare_depart','$cp_depart','$ville_depart','$gare_arrivee','$ville_arrivee','$cp_arrivee',currval('serial_num_billet'))";
	$vQuery=pg_query($vConn, $vSql);
	$vSql="SELECT LAST_VALUE FROM SERIAL_NUM_BILLET";
	$vQuery=pg_query($vConn, $vSql);
	if($vQuery){
		$vResult=pg_fetch_array($vQuery);
		$numbillet = $vResult[0];
		echo "Achat success!<br/>Votre Numero de Billet est :<h3>".$numbillet."</h3>";
		$page_retour = "recherche.html";
		echo '<br/><a href='.$page_retour.'>retourne à la page précedente :</a>';
	}
?>
</div>
</body>
</html>