<html>
	<head>
	<meta charset="utf-8">
	<title>Resultat d'annulation</title>
	<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	<div id="wrapper">
	<div id="menu-wrapper">
		<div id="menu" class="container">
			<ul>
				<li class="current_page_item"><a href="">Homepage</a></li>
				<li><a href="recherche.html">Rechercher un trajet</a></li>
				<li><a href="gerer_billets.html">Gérer vos billets</a></li>
			</ul>
		</div>
	</div>
	
<?php
include "connect.php";
	$billet = $_COOKIE['billet'];
	$vConn = fConnect();
	$vSql = "UPDATE billets SET status = 'A' WHERE numero = '$billet' ";
	$vQuery=pg_query($vConn, $vSql);
	if($vQuery){
		echo "success, votre billet est bien annulé!";
		echo "<br/><a href=modifier_billet.php />retourenez à la page de gestion.";
	}
?>

</body>
</html>