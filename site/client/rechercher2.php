<html>
<head>
<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript">
    function acheter(num) {
    	var x=document.getElementById(num);
        var itineraire = $(x).find("#numero_itineraire").html();
        var date_dep = $(x).find("#date_dep").html();
        var heure = $(x).find("#heure").html();
        var jour = $(x).find("#jour").html();
        var train = $(x).find("#train").html();
        var gare_depart = $(x).find("#gare_depart").html();
        var cp_depart = $(x).find("#cp_depart").html();
        var ville_depart = $(x).find("#ville_depart").html();
        var gare_arrivee = $(x).find("#gare_arrivee").html();
        var ville_arrivee = $(x).find("#ville_arrivee").html();
        var cp_arrivee = $(x).find("#cp_arrivee").html();
        var prix = $(x).find("#prix").html();
        $.cookie("numero_itineraire", itineraire);
        $.cookie("date_dep", date_dep);
        $.cookie("heure", heure);
        $.cookie("jour", jour);
        $.cookie("train", train);
        $.cookie("gare_depart", gare_depart);
        $.cookie("cp_depart", cp_depart);
        $.cookie("ville_depart", ville_depart);
        $.cookie("gare_arrivee", gare_arrivee);
        $.cookie("ville_arrivee", ville_arrivee);
        $.cookie("cp_arrivee", cp_arrivee);
        $.cookie("prix", prix);



        location.href = "billet.html";
    }
</script>
<meta charset='utf-8' />
</head>
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
<?php
	date_default_timezone_set('Europe/Paris');
	$nomgare_depart = $_POST['nomgare_depart'];
	$nomgare_arrivee = $_POST['nomgare_arrivee'];
	$heure = $_POST['heure'];
	$date = $_POST['date'];
	$my_date = date('D', strtotime($date));
	switch ($my_date) {
		case 'Mon':
			$day = 'Lundi';
			break;
		case 'Tue':
			$day = 'Mardi';
			break;
		case 'Wed':
			$day = 'Mercredi';
			break;
		case 'Thu':
			$day = 'Jeudi';
			break;
		case 'Fri':
			$day = 'Vendredi';
			break;
		case 'Sat':
			$day = 'Samedi';
			break;
		case 'Sun':
			$day = 'Dimanche';
			break;
		default:
			$day = 'Lundi';
			break;
	}

	include "connect.php";
	$vConn = fConnect();
	$vSql = "SELECT distinct gare_depart.numero, type_train.typ, type_train.numero as numtrain, gare_depart.day as jour, gare_depart.horrairepassage as horaire_depart,'$date' as date_dep, gare_depart.ville as ville_depart,gare_depart.nom as gare_depart, gare_depart.cp as cp_depart,  '$date' as date_arrivee,gare_arrivee.horrairepassage as horaire_arrive,gare_arrivee.ville as ville_arrivee ,gare_arrivee.nom as gare_arrivee, gare_arrivee.cp as cp_arrivee from (select * from dessert D  where horrairepassage > '$heure' and day = '$day' ) as gare_depart, (select * from dessert D where horrairepassage > '$heure' and day = '$day' ) as gare_arrivee,(select * from trains ) as type_train,(select * from itineraire_horaire) as horaire where (gare_depart.numero = gare_arrivee.numero) AND (horaire.numitineraire = gare_depart.numero) AND (gare_depart.day = gare_arrivee.day) AND ( gare_depart.nom = '$nomgare_depart')  AND  (gare_arrivee.nom = '$nomgare_arrivee') AND (gare_arrivee.horrairepassage > gare_depart.horrairepassage) AND (horaire.numtrain = type_train.numero) AND (horaire.jour = gare_depart.day)";
	$vQuery=pg_query($vConn, $vSql);	
?>
<table border="1" class='table'>
			<tr>
				<td width="100pt"><b>Numero itineraire</b></td>
				<td width="100pt"><b>Type de train</b></td>
				<td width="100pt"><b>Numero de train</b></td>
				<td width="100pt"><b>Jour Depart</b></td>
				<td width="100pt"><b>Date Depart</b></td>
				<td width="100pt"><b>Horaire Depart</b></td>
				<td width="100pt"><b>Ville Depart</b></td>
				<td width="100pt"><b>Gare Depart</b></td>
				<td width="100pt"><b>CP Depart</b></td>
				<td width="100pt"><b>Date Arrivee</b></td>
				<td width="100pt"><b>Horaire Arrivee</b></td>
				<td width="100pt"><b>Ville Arrivee</b></td>
				<td width="100pt"><b>Gare Arrivee</b></td>
				<td width="100pt"><b>CP Arrivee</b></td>
				<td width="100pt"><b>Prix €</b></td>
				<td width="100pt"><b>Acheter</b></td>

			</tr>
			<?php
				$i = 0;
				while($vResult=pg_fetch_array($vQuery)){
					if(isset($vResult[0])){
						switch ($vResult['typ']){
							case 'TER' :
							$unite = 0.2;
							break;
							case 'INTER' :
							$unite = 0.3;
							break;
							case 'TGV' :
							$unite = 0.5;
							break;
						}
						$prix = (strtotime ($vResult['horaire_arrive'])-strtotime ($vResult['horaire_depart']))/60*$unite;
						echo "<tr id='$i'>";
						echo "<td id = 'numero_itineraire'>$vResult[numero]</td>";
						echo "<td id = 'typ'>$vResult[typ]</td>";
						echo "<td id = 'train'>$vResult[numtrain]</td>";
						echo "<td id = 'jour'>$vResult[jour]</td>";
						echo "<td id = 'date_dep'>$vResult[date_dep]</td>";
						echo "<td id = 'heure'>$vResult[horaire_depart]</td>";
						echo "<td id = 'ville_depart'>$vResult[ville_depart]</td>";
						echo "<td id = 'gare_depart'>$vResult[gare_depart]</td>";
						echo "<td id = 'cp_depart'>$vResult[cp_depart]</td>";
						echo "<td id = 'date_arrivee'>$vResult[date_arrivee]</td>";
						echo "<td id = 'horaire_arrive'>$vResult[horaire_arrive]</td>";
						echo "<td id = 'ville_arrivee'>$vResult[ville_arrivee]</td>";
						echo "<td id = 'gare_arrivee'>$vResult[gare_arrivee]</td>";
						echo "<td id = 'cp_arrivee'>$vResult[cp_arrivee]</td>";
						echo "<td id = 'prix'>$prix</td>";
						echo "<td ><button type='button' onclick = 'acheter($i);' class='button'>Acheter!</button></td>";
						echo "</tr><br/>";
						}
						else{
							echo "pas de train dans cette horaire!";
						}
						$i++;
				}
				
			
echo '</table>';
if($vQuery){
					//echo "success!<br/>";
					$page_retour = "recherche.html";
					echo '<p><a href='.$page_retour.'>retourne à la page précedente :</a><p>';
				}
			?>
</html>