<?php
session_start();
// connexion BDD
require ('\Wamp\www\suldabhaia\modele\modele3.php');
			if (isset($_SESSION['id'] ))
		{
			$requser=$bdd->prepare("SELECT * FROM personne WHERE id_personne=?");
			$requser->execute(array($_SESSION['id']));
			$user=$requser->fetch();
			$_SESSION['id']=$user['id_personne'];
			$_SESSION['login']=$user['login'];
			$_SESSION['email']=$user['email'];
			$_SESSION['couleur']=$user['couleur_grade'];
			$_SESSION['grade']=$user['id_grade'];
//je verifie l id pour voir	echo $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
 <meta charset ="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" type="text/css" href="\public\style3.css">
<head>
	<title>sdb famillia </title>
</head>
	<?php include ("C:\Wamp\www\suldabhaia\header2.php");
		?>
		<body>
		<br/>
			<h1>Bonjour <?php echo $user['login']; ?> !</h1> 		
 				<div id="deconnection" class="deconnection">
	    			<a href="deconnexion.php">débranche-toi !</a>
	    		</div>	
				<div id="profil" class="profil">
					<p>Mon Nom : <?php echo  $user['login']; ?><p>
					<p>Mon email : <?php echo  $user['email']; ?><p>
					<p>Ma ceinture : <?php echo $user['couleur_grade'];?><p>
				</div>
<?php

?>				
<div>
	<H1> Choisis ta formule : </H1>
		<ul>
			<li>1 cour par semaine : 
	<?php 
	$produit=$bdd->prepare("SELECT * FROM produits WHERE id=7");
	$produit->execute(array());
	$data=$produit->fetch();
	$produits['idProduit']=$data['id'];
	$produits['libelleProduit']=$data['libelleProduit'];
	$produits['prixProduit']=$data['prixProduit'];
	$produits['description']=$data['description'];
	echo $produits['prixProduit'] ?> € pour l'année</li>

			<li>2 cours par semaine : <?php 
	$produit=$bdd->prepare("SELECT * FROM produits WHERE id=8");
	$produit->execute(array());
	$data=$produit->fetch();
	$produits['idProduit']=$data['id'];
	$produits['libelleProduit']=$data['libelleProduit'];
	$produits['prixProduit']=$data['prixProduit'];
	$produits['description']=$data['description'];
	echo $produits['prixProduit'] ?> € pour l'année</li>

			<li>3 cours ou plus par semaine : 
	<?php 
	$produit=$bdd->prepare("SELECT * FROM produits WHERE id=9");
	$produit->execute(array());
	$data=$produit->fetch();
	$produits['idProduit']=$data['id'];
	$produits['libelleProduit']=$data['libelleProduit'];
	$produits['prixProduit']=$data['prixProduit'];
	$produits['description']=$data['description'];
	echo $produits['prixProduit'] ?> € pour l'année</li>
	</ul>
		<p>Il faut ajouter les frais de  
<?php
$produit=$bdd->prepare("SELECT * FROM produits WHERE id=6");
	$produit->execute(array());
	$data=$produit->fetch();
	$produits['idProduit']=$data['id'];
	$produits['libelleProduit']=$data['libelleProduit'];
	$produits['prixProduit']=$data['prixProduit'];
	$produits['description']=$data['description'];
	echo $produits['prixProduit'] ?> €</p>
</div>
	<div id="formule" class="formule">
		<h2>Combien de cours veux tu ? </h2>
			<form action="mesAbonnements.php" method="POST">		
				<select name="nombreDecours">
					<option value="un" selected="selected">un cour par semaine</option>
					<option value="deux">deux cours par semaine</option>
					<option value="trois">trois cours et plus par semaine</option>
				</select>
		<h2> Maintenant parlons tenue :</h2>	
			<p> tu veux quoi : </p>
				<div id="vetement">
					<label for="abada">abada 50 €</label>
					<input type="checkbox" name="abada" id="abada" value="abada"></br>
					<label for="tshirt">tshirt 50 €</label>
					<input type="checkbox" name="tshirt" id="tshirt" value="un tshirt"></br></br>
				</div></br></br>
		<h2> Et coté musique :</h2>
			<label for="gunga">un berimbao gunga : 50€ </label>
			<input type="checkbox" name="case_1" id="gunga"  value="gunga"></br>
			<label for="media">un berimbao media : 50€ </label>
			<input type="checkbox" name="case_2"  id="media" value="media"></br>
			<label for="viola">un berimbao viola : 50€</label>
			<input type="checkbox" name="case_3"  id="viola" value="viola"><br />
			<input type="submit" name="valider" value="Commander"/>&nbsp&nbsp
			<input type="submit" name="retour" value="retour">
			</form>
	<div id="paiement" class="paiement"> <a href="https://www.paypal.com/fr/webapps/mpp/home">paiement mettre une api de paiement </a></div>
<?php 

$abo=$bdd->prepare("SELECT * FROM abonnement WHERE id_personne=".$_SESSION['id']);
$abo->execute(array());
$abonement=$abo-> fetch();
$abonements['id_abo']=$abonement['id_abo'];
$abonements['id_personne']=$abonement['id_personne'];
$abonements['nbr_de_cours']=$abonement['nbr_de_cours'];
$abonements['vetement']=$abonement['vetement'];
$abonements['vetement_1']=$abonement['vetement_1'];
$abonements['instru']=$abonement['instru'];
$abonements['instru_1']=$abonement['instru_1'];
$abonements['instru_2']=$abonement['instru_2'];

//ok quand on valide on check :
if (isset($_POST['valider']))
	{ 
	if (isset($_POST['abada']) && (isset($_POST['case_1'])) && (isset($_POST['case_2'])) && (isset($_POST['case_3'])) && (isset($_POST['case_1'])) && (isset($_POST['tshirt']))) 
	{//si tout est coché ok 
		
		$nbr_de_cours=$_POST['nombreDecours'];
		$abada=$_POST['abada'];
		$tshirt=$_POST['tshirt'];
		$instruGunga=$_POST['case_1'];
		$instruMedia=$_POST['case_2'];
		$instruViola=$_POST['case_3'];
			// on met a jour la BDD
		$integrer=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`vetement`='$abada',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt' WHERE `id_personne`=".$_SESSION['id']);
		$integrer->execute();

		header("Location: pageUser.php?id=".$_SESSION['id']);
		
	} 
		elseif (isset($_POST['abada']) && (isset($_POST['tshirt']))&& (isset($_POST['case_1'])) && (!isset($_POST['case_2'])) && (!isset($_POST['case_2']))) 
	{//si tout les vet sont coché  un Gunga 
		
		$nbr_de_cours=$_POST['nombreDecours'];
		$abada=$_POST['abada'];
		$tshirt=$_POST['tshirt'];
		$instruGunga=$_POST['case_1'];
		$instruMedia="pas de Media";
		$instruViola="pas de Viola ";
			// on met a jour la BDD
		$integrer=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`vetement`='$abada',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt' WHERE `id_personne`=".$_SESSION['id']);
		$integrer->execute();

		header("Location: pageUser.php?id=".$_SESSION['id']);
		
	} 
elseif (isset($_POST['abada']) && (isset($_POST['tshirt']))&& (isset($_POST['case_2'])) && (!isset($_POST['case_1'])) && (!isset($_POST['case_3']))) 
	{//si tout les vet sont coché  un Gunga 
		
		$nbr_de_cours=$_POST['nombreDecours'];
		$abada=$_POST['abada'];
		$tshirt=$_POST['tshirt'];
		$instruGunga="pas de gunga";
		$instruMedia=$_POST['case_2'];
		$instruViola="pas de Viola ";
			// on met a jour la BDD
		$integrer=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`vetement`='$abada',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt' WHERE `id_personne`=".$_SESSION['id']);
		$integrer->execute();

		header("Location: pageUser.php?id=".$_SESSION['id']);
		
	} 
	elseif (isset($_POST['abada']) && (isset($_POST['tshirt']))&& (isset($_POST['case_3'])) && (!isset($_POST['case_1'])) && (!isset($_POST['case_2'])))  
	{//si tout les vet sont coché  un Gunga 
		
		$nbr_de_cours=$_POST['nombreDecours'];
		$abada=$_POST['abada'];
		$tshirt=$_POST['tshirt'];
		$instruGunga="pas de gunga";
		$instruMedia="pas de Media";
		$instruViola=$_POST['case_3'];
			// on met a jour la BDD
		$integrer=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`vetement`='$abada',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt' WHERE `id_personne`=".$_SESSION['id']);
		$integrer->execute();

		header("Location: pageUser.php?id=".$_SESSION['id']);
		
	} 
elseif (isset($_POST['abada']) && (isset($_POST['tshirt'])) && (isset($_POST['case_1']))&& (isset($_POST['case_2'])) && (!isset($_POST['case_3']))) 
	{//si tout les vet sont coché  un Gunga 
		
		$nbr_de_cours=$_POST['nombreDecours'];
		$abada=$_POST['abada'];
		$tshirt=$_POST['tshirt'];
		$instruGunga=$_POST['case_1'];
		$instruMedia=$_POST['case_2'];
		$instruViola="pas de Viola";
			// on met a jour la BDD
		$integrer=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`vetement`='$abada',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt' WHERE `id_personne`=".$_SESSION['id']);
		$integrer->execute();

		header("Location: pageUser.php?id=".$_SESSION['id']);
		
	} 
	elseif (isset($_POST['abada']) && (isset($_POST['tshirt'])) && (isset($_POST['case_1']))&& (isset($_POST['case_3']))&& (!isset($_POST['case_2'])))  
	{//si tout les vet sont coché  un Gunga 
		
		$nbr_de_cours=$_POST['nombreDecours'];
		$abada=$_POST['abada'];
		$tshirt=$_POST['tshirt'];
		$instruGunga=$_POST['case_1'];
		$instruMedia="pas de Media";
		$instruViola=$_POST['case_3'];
			// on met a jour la BDD
		$integrer=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`vetement`='$abada',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt' WHERE `id_personne`=".$_SESSION['id']);
		$integrer->execute();

		header("Location: pageUser.php?id=".$_SESSION['id']);
		
	} 
	elseif (isset($_POST['abada']) && (isset($_POST['tshirt'])) && (isset($_POST['case_2']))&& (isset($_POST['case_3'])) && (!isset($_POST['case_1']))) 
	{//si tout les vet sont coché  un Gunga 
		
		$nbr_de_cours=$_POST['nombreDecours'];
		$abada=$_POST['abada'];
		$tshirt=$_POST['tshirt'];
		$instruGunga="pas de Gunga";
		$instruMedia=$_POST['case_2'];
		$instruViola=$_POST['case_3'];
			// on met a jour la BDD
		$integrer=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`vetement`='$abada',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt' WHERE `id_personne`=".$_SESSION['id']);
		$integrer->execute();

		header("Location: pageUser.php?id=".$_SESSION['id']);
		
	} 
	

				elseif (isset($_POST['abada']) && (!isset($_POST['tshirt'])) && (isset($_POST['case_1']))&& (isset($_POST['case_2']))&& (isset($_POST['case_3']))) 
			{// on verifie si un abada et tous les vet		 		
			
			$abada =$_POST['abada'];// case de vetement vide 
			$tshirt="aucun tshirt";
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga=$_POST['case_1']; // choix de l'instru
			$instruMedia=$_POST['case_2'];
			$instruViola=$_POST['case_3']; 
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}
				elseif (isset($_POST['abada']) && (!isset($_POST['tshirt'])) && (isset($_POST['case_1']))&& (!isset($_POST['case_2']))&& (!isset($_POST['case_3']))) 
			{// on verifie si seul abada et 1 instru  		 		
			
			$abada =$_POST['abada'];// case de vetement vide 
			$tshirt="aucun tshirt";
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga=$_POST['case_1']; // choix de l'instru
			$instruMedia="pas de Media";
			$instruViola="pas de viola"; 
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}

			elseif (isset($_POST['abada']) && (!isset($_POST['tshirt'])) && (isset($_POST['case_2']))&& (!isset($_POST['case_1']))&& (!isset($_POST['case_3']))) 
			{// on verifie si seul abada et 1 instru 2 		 		
			
			$abada =$_POST['abada'];// case de vetement vide 
			$tshirt="aucun tshirt";
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga= "pas de gunga";// choix de l'instru
			$instruMedia=$_POST['case_2'];
			$instruViola="pas de viola"; 
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}

			elseif (isset($_POST['abada']) && (!isset($_POST['tshirt'])) && (isset($_POST['case_3']))&& (!isset($_POST['case_1']))&& (!isset($_POST['case_2']))) 
			{// on verifie si seul abada et 1 instru viola 		 		
			
			$abada =$_POST['abada'];// case de vetement vide 
			$tshirt="aucun tshirt";
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga= "pas de gunga";// choix de l'instru
			$instruMedia="pas de media";
			$instruViola=$_POST['case_3'];
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}

			elseif (isset($_POST['abada']) && (!isset($_POST['tshirt'])) && (isset($_POST['case_2']))&& (isset($_POST['case_1']))&& (!isset($_POST['case_3']))) 
			{// on verifie si seul abada et 1 instru gunga et media	 		
			
			$abada =$_POST['abada'];// case de vetement vide 
			$tshirt="aucun tshirt";
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga= $_POST['case_1'];// choix de l'instru
			$instruMedia=$_POST['case_2'];
			$instruViola="pas de viola";
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}
				elseif (isset($_POST['abada']) && (!isset($_POST['tshirt'])) && (isset($_POST['case_3']))&& (isset($_POST['case_2']))&& (!isset($_POST['case_1']))) 
			{// on verifie si seul abada et 1 instru media et viola		 		
			
			$abada =$_POST['abada'];// case de vetement vide 
			$tshirt="aucun tshirt";
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga= "pas de Gunga";// choix de l'instru
			$instruMedia=$_POST['case_2'];
			$instruViola=$_POST['case_3'];
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}
			



			elseif (!isset($_POST['abada']) && (!isset($_POST['tshirt'])) && (isset($_POST['case_3']))&& (isset($_POST['case_2']))&& (isset($_POST['case_1']))) 
			{// on verifie si seul abada et 1 instru media et viola		 		
			
			$abada ="aucun abada";// case de vetement vide 
			$tshirt="aucun tshirt";
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga= $_POST['case_1'];// choix de l'instru
			$instruMedia=$_POST['case_2'];
			$instruViola=$_POST['case_3'];
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}
			



			elseif (!isset($_POST['abada']) && (isset($_POST['tshirt'])) && (isset($_POST['case_3']))&& (isset($_POST['case_2']))&& (isset($_POST['case_1']))) 
			{// on verifie si seul abada et 1 instru media et viola		 		
			
			$abada ="aucun abada";// case de vetement vide 
			$tshirt=$_POST['tshirt'];
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga= $_POST['case_1'];// choix de l'instru
			$instruMedia=$_POST['case_2'];
			$instruViola=$_POST['case_3'];
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}


			elseif (!isset($_POST['abada']) && (isset($_POST['tshirt'])) && (isset($_POST['case_1']))&& (!isset($_POST['case_2']))&& (!isset($_POST['case_3']))) 
			{// on verifie si seul tshirt et 1 instru  gunga		 		
			
			$abada ="aucun abada";// case de vetement vide 
			$tshirt=$_POST['tshirt'];
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga= $_POST['case_1'];// choix de l'instru
			$instruMedia="pas de Media";
			$instruViola="pas de viola";
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}

			elseif (!isset($_POST['abada']) && (isset($_POST['tshirt'])) && (isset($_POST['case_2']))&& (!isset($_POST['case_1']))&& (!isset($_POST['case_3']))) 
			{// on verifie si seul tshirt et 1 instru  gunga		 		
			
			$abada ="aucun abada";// case de vetement vide 
			$tshirt=$_POST['tshirt'];
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga= "pas de Gunga";// choix de l'instru
			$instruMedia=$_POST['case_2'];
			$instruViola="pas de viola";
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}

				elseif (!isset($_POST['abada']) && (isset($_POST['tshirt'])) && (isset($_POST['case_3']))&& (!isset($_POST['case_1']))&& (!isset($_POST['case_2']))) 
			{// on verifie si seul tshirt et 1 instru  gunga		 		
			
			$abada ="aucun abada";// case de vetement vide 
			$tshirt=$_POST['tshirt'];
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga= "pas de Gunga";// choix de l'instru
			$instruMedia="pas de Media";
			$instruViola=$_POST['case_3'];
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}


			elseif (!isset($_POST['abada']) && (isset($_POST['tshirt'])) && (isset($_POST['case_1']))&& (isset($_POST['case_3']))&& (!isset($_POST['case_2']))) 
			{// on verifie si seul tshirt et 1 instru  gunga		 		
			
			$abada ="aucun abada";// case de vetement vide 
			$tshirt=$_POST['tshirt'];
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga= $_POST['case_1'];// choix de l'instru
			$instruMedia="pas de Media";
			$instruViola=$_POST['case_3'];
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}

			elseif (!isset($_POST['abada']) && (isset($_POST['tshirt'])) && (isset($_POST['case_1']))&& (isset($_POST['case_2']))&& (!isset($_POST['case_3']))) 
			{// on verifie si seul tshirt et 1 instru  gunga		 		
			
			$abada ="aucun abada";// case de vetement vide 
			$tshirt=$_POST['tshirt'];
			$nbr_de_cours=$_POST['nombreDecours'];//case de nombre de cours par semaine
			$instruGunga= $_POST['case_1'];// choix de l'instru
			$instruMedia=$_POST['case_2'];
			$instruViola="pas de Viola";
		
			//mis à jour de la bdd
			$integrer1=$bdd->prepare("UPDATE `abonnement` SET `nbr_de_cours`='$nbr_de_cours',`instru`='$instruGunga',`instru_1`='$instruMedia',`instru_2`='$instruViola',`vetement_1`='$tshirt', `vetement`='$abada' WHERE `id_personne`=".$_SESSION['id']);
			$integrer1->execute();
		
			header("Location: pageUser.php?id=".$_SESSION['id']);
			}
		}else{ // s'affiche a l'affichage de la page une info quoi!
			if (isset($_POST['retour'])) 
			{//retour au menu
				header("Location: pageUser.php?id=".$_SESSION['id']);
				}
			}
		}
?>	
</div>
</body>
</html>