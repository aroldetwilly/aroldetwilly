<?php
session_start();
// connexion BDD
require ('\Wamp\www\suldabhaia\modele\modele3.php');
//recupere les infos de sessions pour avoir les données user
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
//je verifie l id pour voir 
			//echo $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
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
				<div id="mescours" class="mescours">
					<h2>quel cours tu choisis ? </h2>
						<form action="choixCours.php" method="POST">		
							<h2> fais ton choix :</h2>	
								<label for="ado/adulte">cours ado / adulte </label>
								<input type="checkbox" name="case[]" id="case"  value="1" ></br>
									<label for="cours pour tous">cours pour tous </label>
									<input type="checkbox" name="case[]"  id="case"value="2" ></br>
										<label for="Baby">Baby </label>
										<input type="checkbox" name="case[]" id="case" value="3" ></br>
											<label for="baby famille">baby famille </label>
											<input type="checkbox" name="case[]"id="case"  value="4" ></br>
												<label for="cours enfant">cours enfant </label>
													<input type="checkbox" name="case[]"  id="case"value="5" ></br>
													<input type="submit" name="valider" value="Roda Time"/>
													<input type="submit" name="retour" value="retour">
						</form>
<?php 
//requette pour afficher les données du user ( peut etre faire une fonction )
	$requette=$bdd->prepare("SELECT DISTINCT * FROM cours RIGHT JOIN mes_cours ON mes_cours.id_cours=cours.id_cours WHERE mes_cours.id_personne=?");
	$requette->execute(array($_SESSION['id']));
			while ( $mes_cours=$requette->fetch()) {// tant que l'user à des cours on les affiche a la suite
				echo "vous êtes déjà inscrit au cours : <strong> ".$mes_cours['nom']."</strong>   à :  <strong>" .$mes_cours['lieu']."</strong> à : ".$mes_cours['heure_debut_1']." Cours assuré par : ".$mes_cours['professeur']."</br>"  ;
				}
// quand on valide les cases 
			if(isset($_POST['valider'])){
				$choix=$_POST['case']; //j enregistre chaque choix  dans une nouvelle variable 
				foreach ($choix as $cours ) { // pour chaque choix je met à jour ma bdd uniquement les éléments cochés
						$integrer=$bdd->prepare("INSERT INTO mes_cours (id_personne,id_cours ) VALUES(?,?) ");
						$integrer->execute(array($user['id_personne'],$cours));
		 				header("Location: pageUser.php?id=".$_SESSION['id']);
						}
				} 
//si je ne coche rien bouton retour à ma page de profil 
						if (isset($_POST['retour'])) {
							echo "on y va";
							header("Location: pageUser.php?id=".$_SESSION['id']);
							}
						}
?>
