<?php 
$nom = strtoupper($_REQUEST['debutnom']);

header ( 'Content-Type: text/xml' );  
echo '<?xml version="1.0" encoding="utf-8" ?>'; 
if(isset($nom)){
echo '<gares>';  
include "connect.php";
	$vConn = fConnect();
	$vSql="SELECT * from gares where nomgare like '%$nom%';";
	$vQuery=pg_query($vConn, $vSql);
	while($vResult=pg_fetch_array($vQuery)){
		echo "
		<gare> 
   			<name>$vResult[nomgare]</name> 
     		<cp>$vResult[cp]</cp> 
     		<city>$vResult[ville]</city> 
     		<address>$vResult[adresse]</address> 
		</gare> ";
	}
echo '</gares>';  
}
?> 