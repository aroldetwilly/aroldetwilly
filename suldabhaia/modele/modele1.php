<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test_sdb;charset=utf8','root','');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (exception $e)

{
	die ('Erreur : '.$e->getMessage());
}

if (isset($_SESSION['id']) AND $_SESSION['id']>0){
	$getid=intval($_GET['id']);
	$requser=$bdd->prepare("SELECT * FROM personne WHERE id_personne=?");
	$requser->execute(array($getid));
	$userinfo=$requser->fetch();
	$_SESSION['id']=$userinfo['id_personne'];
	$_SESSION['login']=$userinfo['login'];
	$_SESSION['email']=$userinfo['email'];
	$_SESSION['couleur']=$userinfo['couleur_grade'];
	$_SESSION['grade']=$userinfo['id_grade'];	
	}//ligne 15
	?>

?>