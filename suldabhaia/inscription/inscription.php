<?php
	require('\Wamp\www\suldabhaia\modele\modele.php');

?>

<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta charset ="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="HandheldFriendly" content="true">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" type="text/css" href="/public/style.css">
		<title>SulDB Famillia inscription</title>
	</head>

	<body>
		<h1>Quoi t'es pas inscris!! Allez Go :</h1>
		<div id="fond-vert" class="fond-vert">
		<div class="form"><form action="inscription.php" method="post" name="">
			<label>login : </label><br/>
			<input type="text" name="login" value="<?php if (isset($login)){echo $login;} ?>"><br/><br/>
			<label for="mot_de_passe">mot de passe : </label><br/>
			<input type="password" name="mot_de_passe"><br/><br/>
			<label>re mot de passe : </label><br/>
			<input type="password" name="remot_de_passe"><br/><br/>
			<label>saisi ton email  : </label><br/>
			<input type="email" name="email" value="<?php if(isset($email)){echo $email;}?>"><br/><br/>
			<input type="submit" id="retour" class="retour"name="valider" value="Go !">
		</form>
			</div>
			</div>
			<div id="oups" class="oups" style="position: relative; left:200px; top:25px;">
		<?php
		if (isset($erreur))
		{
			echo "$erreur";
		}
		?>
		</div>
	</body>
	</html>
