<?php
try // connction bd
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test_sdb;charset=utf8','root','');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//return $bdd;
	}
	catch (exception $e)

	{
		die ('Erreur : '.$e->getMessage());
	}

if (isset($_POST['valider']))
		{	
		$login = htmlspecialchars($_POST['login']);
		$email = htmlspecialchars($_POST['email']);
		$password = ($_POST['mot_de_passe']);
		$password2 = ($_POST['remot_de_passe']);
				
			if(!empty($_POST['login']) AND (!empty($_POST['mot_de_passe']) AND (!empty($_POST['remot_de_passe']) AND(!empty($_POST['email'])) )))
				{
					if(filter_var($email, FILTER_VALIDATE_EMAIL)) // demande un format email
					{
					$reqmail= $bdd->prepare("SELECT * FROM personne WHERE email=?");
					$reqmail->execute(array($email));
					$mailexist=$reqmail->rowCount();

						if ($mailexist==0) // mail inexistant dans la db
						{	
						
						$reqlogin= $bdd->prepare("SELECT * FROM personne WHERE login=?");
						$reqlogin->execute(array($login));
						$loginexist=$reqlogin->rowCount();
							if ($loginexist==0) // login inexistant dans la db
							{			
								if($password == $password2)
								{
								$req=$bdd->prepare("INSERT INTO personne (login,mot_de_passe, email) VALUES(?,?,?)");		
								$req->execute(array($login,$password,$email ));
								$erreur= "bien joué! Maintenant connecte toi et vas choisir ta formule d'abonnement => <a href=\"\connexion\connexion.php\">Me Connecter</a>";
								}		
								else{
									$erreur = "Veuillez saisir des mdp identiques !";
									}
							}
							else{						
								$erreur="login déjà utilisé !";
								}
											
				}else {
					$erreur="email déjà utilisé !";
				}

				}else{
$erreur="email invalide !";
				}}
				else{
				$erreur="Tous les chamsp doivent être remplit";
					}
					
				}			
?>

