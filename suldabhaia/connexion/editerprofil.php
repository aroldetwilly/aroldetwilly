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
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset ="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" type="text/css" href="public\style3.css">
    <title>Welcome SDB Famillia</title>
</head>
<body>
	<div align="center">
	<h1>Editer mon profil :</h1>
<!--j 'affiche des infos de bases sur le profile  -->
	<p>Mon Nom : <?php echo $user['login']; ?></p>
	<p>Mon email : <?php echo $user['email'];?></p>
	<p>Ma corde : <?php echo $user['couleur_grade'];?></p>

		<form method="POST" action="editerprofil.php">	
<!-- je vais afficher sous forme de liste les choix de grade (recuperer sur ma bdd table grade) -->			
<?php
	$grade=$bdd->prepare("SELECT * FROM grade ");
	$grade->execute(array());
	
    echo 'Ma corde : <select name="couleur">' ;
		while ($usergrade=$grade->fetch())
		
		// recupere et se positionne sur les données de la BDD par defaut : 
			if($usergrade['id_grade'] == $user['id_grade'])
			{
				echo '<option value ="'.$usergrade['id_grade'].'"selected=selected">'.$usergrade['couleur_grade'].'</option>';
			}
			else{
				echo'<option  value ="'.$usergrade['couleur_grade'].'">'.$usergrade['couleur_grade'].'</option>';
				}
				echo'</select></br>';		
?>
				</br></br>


			<input type="submit" name="valider" value="fight"/>
			<input type="submit" name="retour" value="retour">
		</form>
</body>
</html>	

<?php
if (isset($_POST['retour'])) {
							echo "on y va";
							header("Location: pageUser.php?id=".$_SESSION['id']);
							}
// quand on valide on recupere la nouvelle couleur selectionné 	
if (isset($_POST['valider']))
	{ 
		$couleur=($_POST['couleur']);	
	//on assoxie la session pour verifier la mise à jour apres :
	
		$requser=$bdd->prepare("SELECT * FROM personne WHERE id_personne=?");
		$requser->execute(array($_SESSION['id']));
		$user=$requser->fetch();
		$_SESSION['id']=$user['id_personne'];
		$_SESSION['login']=$user['login'];
		$_SESSION['email']=$user['email'];
		$_SESSION['couleur']=$user['couleur_grade'];
		$_SESSION['grade']=$user['id_grade'];
		

			//Si le nouveau choix correspond à l'nacien on bloque : 		
			if ($couleur!=$usergrade['couleur_grade'])
				{
					$editer=$bdd->prepare("UPDATE personne,grade SET personne.id_grade=grade.id_grade ,personne.couleur_grade=grade.couleur_grade WHERE id_personne=? AND grade.couleur_grade=?");
					$editer->execute(array($user['id_personne'],$couleur));
					 
					 //retour au profil général :
					 header("Location: pageUser.php?id=".$_SESSION['id']);
				}
				else{		
					echo "attention les cordes sont les mêmes";	
					}			
			}
		
?>
<?php
$grade1=$bdd->prepare("SELECT * FROM grade ");
	$grade1->execute(array());
	while ($usergrade1=$grade1->fetch())
	 echo "corde de couleur : <strong>".$usergrade1['couleur_grade']."</strong> / ".$usergrade1['niveau']."</br>"; 

?>