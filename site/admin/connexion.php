<html>
	<head>
		<title>Connexion</title>
		<meta charset="utf-8">
        <link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
        <link href="../client/css/style.css" rel="stylesheet" type="text/css" media="screen" />
        <script src="http://code.jquery.com/jquery-1.8.0.js"></script>
        <script src="../client/js/jquery.cookie.js"></script>
        <script>
            $(document).ready(function(){
                $('#deconnect').click(function() {
                        $.cookie("pseudo", null,{ expires: -1} );
                        $.cookie("pass", null, { expires: -1} );
                        //$(location).attr('href',"./index.html");
                        });

            });
        </script>
</head>
<?php
 if (isset($_COOKIE['pseudo']) && isset($_COOKIE['pass'])) { 
    $pseudo = $_COOKIE['pseudo'];
    $pass = $_COOKIE['pass'];
}
else{
$pass = $_POST['pass'];
$pseudo = $_POST['pseudo'];
}
//ici on utilise une nouvelle façon (PDO) à connecter à BD au lieu de .
$bdd = new PDO('pgsql:host=tuxa.sme.utc;port=5432;dbname=dbnf17p001;user=nf17p001;password=sVIJm6v5');
 
// Vérification des identifiants
$req = $bdd->prepare('SELECT login ,password FROM user_login WHERE login = :pseudo AND password = :pass');
$req->execute(array(
    'pseudo' => $pseudo,
    'pass' => $pass));
 
$resultat = $req->fetch();
 
if (!$resultat)
{
    echo '<h3>Mauvais identifiant ou mot de passe !</h3>';
    echo ' <br/><a href="./index.html">retournez à la page précedent</a>';
}
else
{
    setcookie("pseudo", $resultat['login']);
    setcookie("pass", $resultat['password']);
    echo '<p>Bienvenue, Vous êtes connecté !<a id="deconnect" href="./index.html"> Deconnecter</a></p><br/><br/>';
    echo '<ul>
    <a href="affiche_membre_pers.php?type_pers=conducteur">Gérer Conducteur</a><br/>
    <a href="affiche_membre_pers.php?type_pers=personnel_gare">Gérer Membre de Gare</a><br/>
    <a href="affiche_gares.php">Gérer Gares</a><br/>
    <a href="affiche_train_conducteur.php">Gérer Conducteur du train</a><br/>
    <a href="affiche_trains.php">Gérer train</a><br/>
    <a href="affiche_itineraire_train.php">Gérer Itineraire du train</a><br/>
    <a href="statistique.php">Statistiques</a><br/>
    </ul>';
}
?>
