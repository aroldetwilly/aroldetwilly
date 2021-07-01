
	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" href=""/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	    <meta name="HandheldFriendly" content="true"/>
	     <link rel="stylesheet" type="text/css" href="/public/style.css">
	</head>
		<body>
			<h1>Ready to fight!</h1>
		
	<div class="form">
		<div id="fond-vert" class="fond-vert">
		<H3>Connexion :</H3>
		<form action="" method="post" name="">
				<label> saisi ton login : </label><br/>
				<input type="text" name="loginconnect" placeholder ="login  "/><br/><br/>
				<label>saisi ton email :</label><br/>
				<input type="email" name="emailconnect" placeholder ="email "/><br/><br/>
				<label>saisi ton mot de passe : </label><br/>
				<input type="password" class="mot_de_passeconnect"name="mot_de_passeconnect" placeholder ="mdp"/><br/><br/>
				<input type="submit" class="valider"name="valider" value="fight"/>
			</form>
		</div>
		</div>
	<?php
	if (isset($erreur))
		{
			echo "$erreur";
		}
	?>	
			
			</body>
			
	</html>
