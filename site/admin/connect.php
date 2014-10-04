<?php
function fConnect () {
	$vHost="tuxa.sme.utc";
	$vPort="5432";
	$vDbname="dbnf17p001";
	$vUser="nf17p001";
	$vPassword="sVIJm6v5";
	$vConn = pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword");
	//echo "Connexion réussie";
	return $vConn;
}

function fListe_train($type){
	$vConn = fConnect();
	$vSql="SELECT * FROM trains";
	$vQuery=pg_query($vConn, $vSql);
	echo '<select name='.$type.'><option value="">choisisez un numero</option>';
	while($vResult=pg_fetch_array($vQuery)){
		echo '<option value ='.$vResult[0].'>'.$vResult[0].'-'.$vResult[1].'</option>';
	}
	echo '</select>';
}

function fListe_itineraire($type){
	$vConn = fConnect();
	$vSql="SELECT * FROM itineraires";
	$vQuery=pg_query($vConn, $vSql);
	echo '<select name='.$type.'><option value="">choisisez un numero</option>';
	while($vResult=pg_fetch_array($vQuery)){
		echo '<option value ='.$vResult[0].'>'.$vResult[0].'</option>';
	}
	echo '</select>';
}
?>
