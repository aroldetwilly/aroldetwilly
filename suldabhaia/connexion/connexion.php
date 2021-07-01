	<?php
	session_start();
	?>

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
	if (isset($_POST['valider']))
	{
		$loginconnect=htmlspecialchars($_POST['loginconnect']);
		$emailconnect = htmlspecialchars($_POST['emailconnect']);;
		$passwordconnect=htmlspecialchars($_POST['mot_de_passeconnect']);
// tous les champs doivent etre saisi//
		if(!empty($loginconnect)  and (!empty($passwordconnect) and (!empty ($emailconnect))))
		{
				// on verifie la présence du compte dans la BD
				if (filter_var($emailconnect, FILTER_VALIDATE_EMAIL))
				{
									
				$requser=$bdd->prepare("SELECT * FROM personne WHERE login=? AND mot_de_passe=? AND email=?");
				$requser->execute(array($loginconnect,$passwordconnect,$emailconnect ));
				$existuser = $requser->rowCount();
				
					//s'il existe alors j'attribue les données à la session et redirige vers la page USER		
					if ($existuser==1)
					{
					$usreinfo =$requser->fetch();
					$_SESSION['id']=$usreinfo['id_personne'];
					$_SESSION['login']=$usreinfo['login'];
					$_SESSION['email']=$usreinfo['email'];
					$_SESSION['couleur_grade']=$usreinfo['couleur_grade'];
					$_SESSION['id_grade']=$usreinfo['id_grade'];
					header("Location: pageUser.php?id=".$_SESSION['id']);

					}	

					else{
					$erreur = "mauvais id ou mdp ou mail!";
					}
			
				
			}
			}else{
			$erreur="Veuillez saisir vos identifiants !";
			}}
	require('ConnexionAffichage.php');
	?>
