<?php
session_start();
require ('\Wamp\www\suldabhaia\modele\modele1.php');

?>
	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta charset ="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="HandheldFriendly" content="true">
		 <link rel="stylesheet" type="text/css" href="\public\style.css">
		<title>Welcome SDB Famillia</title>
	</head>
	<body>
		<div id="haut" class="haut"></div> <!-- retour des boutons accueil-->
		<?php
		include_once ("C:\Wamp\www\suldabhaia\header.php");
		?>
		<br/>
		<div id="fond-vert7" class="fond-vert7">
		<div id="deconnection" class="deconnection">
			<h1>Bonjour <?php echo $userinfo['login'];?></h1> 		
			<a href="deconnexion.php" ><strong>déconnection</strong></a>
		</div>	
		</div>
		<div id="profilColor" class="profilColor">
		<div id="profil" class="profil">
			<p>Mon Nom : <?php echo  $userinfo['login']; ?><p>
				<p>Mon email : <?php echo  $userinfo['email']; ?><p>
					<p>Ma ceinture : <?php echo $userinfo['couleur_grade'];?></p>	
					<?php
					if (isset($_SESSION['id'])AND $userinfo['id_personne']===$_SESSION['id']){
						?>
						<div id="editer" class="editer">
							<a href="editerprofil.php"><strong>Modifier mon profil</strong></a></br>
						</div></br></br>
						<div id="gerer" class="gerer">
							<a href="mesAbonnements.php"><strong>Gérer mes Abonnements</strong></a></br></br>

							<?php
							$abo=$bdd->prepare("SELECT * FROM abonnement WHERE id_personne=?");
							$abo->execute(array($getid));
							$data=$abo->fetch();
						
							
							}
	    		  		 //ligne 52  
	    		  		 ?>
	    		  		 <p> Je suis inscris à : <strong> <?php echo $data['nbr_de_cours']; ?></strong> cours par semaine.</p>
	    		  		 <p>J'ai déjà un : <strong><?php echo $data['vetement']; ?></strong> et, <strong>  <?php echo $data['vetement_1']; ?></strong> j'ai également un (ou des) berimbao(s) de type : <strong><?php echo $data['instru']; ?></strong> ,<strong><?php echo $data['instru_1']; ?></strong>, <strong><?php echo $data['instru_2']; ?></strong>.</p>  			
	    		  		</div></br><br/>
	    		  		<div id="mesCours" class="mesCours">
	    		  			<!-- inserer du php; -->
	    		  			<a href="choixCours.php"><strong>Gérer mes Cours</strong></a></br></br>
	    		  			<h1>Mes Cours : </h1>
	    		  			<?php				
	    		  			$requette=$bdd->prepare("SELECT DISTINCT * FROM cours RIGHT JOIN mes_cours ON mes_cours.id_cours=cours.id_cours WHERE mes_cours.id_personne=?");
	    		  			$requette->execute(array($getid));
	    		  			while ( $mes_cours=$requette->fetch()) {
	    		  				echo "mes cours : <strong> ".$mes_cours['nom']."</strong>   à :  <strong>" .$mes_cours['lieu']."</strong> à : ".$mes_cours['heure_debut_1']." Cours assuré par : ".$mes_cours['professeur']."</br>"  ;
	    		  			}
	    		  			?>
	    		  		</br></br></br>
	    		  			    		  		<table>
	    		  			<tr>
	    		  				<td>&nbsp</td>
	    		  				<td>Lundi &nbsp</td>
	    		  				<td>&nbsp&nbsp</td>
	    		  				<td>Mardi</td>
	    		  				<td>&nbsp</td>
	    		  				<td>Mercredi</td>
	    		  				<td>&nbsp</td>
	    		  				<td>Jeudi</td>
	    		  				<td>&nbsp</td>
	    		  				<td>Vendredi</td>
	    		  				<td>&nbsp</td>
	    		  				<td>Samedi</td>
	    		  				<td>&nbsp</td> 
	    		  				<td>Dimanche </td>
	    		  			</tr>

    		  				<tr>
	    		  				<td></td> <!-- Planing ligne par ligne -->
	    		  				<td><?php $requette=$bdd->prepare("SELECT DISTINCT * FROM planning_cours RIGHT JOIN mes_cours ON mes_cours.id_cours=planning_cours.id_cours WHERE mes_cours.id_personne=?");
	    		  			$requette->execute(array($getid));
	    		  					while($mes_cours = $requette->fetch()){  echo $mes_cours['lundi'];}?></td>

	    		  				<td>&nbsp&nbsp&nbsp</td>

	       		  				<td><?php  $requette=$bdd->prepare("SELECT DISTINCT * FROM planning_cours RIGHT JOIN mes_cours ON mes_cours.id_cours=planning_cours.id_cours WHERE mes_cours.id_personne=?");
	    		  			$requette->execute(array($getid));
	       		  					while($mes_cours = $requette->fetch()){ echo $mes_cours['mardi'];}?></td>

	    		  				<td>&nbsp</td>

	    		  				<td><?php $requette=$bdd->prepare("SELECT DISTINCT * FROM planning_cours RIGHT JOIN mes_cours ON mes_cours.id_cours=planning_cours.id_cours WHERE mes_cours.id_personne=?");
	    		  			$requette->execute(array($getid));
	    		  					 while($mes_cours = $requette->fetch()){echo $mes_cours['mercredi'];}?></td>

	    		  				<td>&nbsp</td>

	    		  				<td><?php $requette=$bdd->prepare("SELECT DISTINCT * FROM planning_cours RIGHT JOIN mes_cours ON mes_cours.id_cours=planning_cours.id_cours WHERE mes_cours.id_personne=?");
	    		  			$requette->execute(array($getid));
	    		  					 while($mes_cours = $requette->fetch()){
	    		  					 	echo $mes_cours['jeudi'];}?></td>

	    		  				<td>&nbsp</td>

	    		  				<td><?php $requette=$bdd->prepare("SELECT DISTINCT * FROM planning_cours RIGHT JOIN mes_cours ON mes_cours.id_cours=planning_cours.id_cours WHERE mes_cours.id_personne=?");
	    		  			$requette->execute(array($getid));
	    		  					 while($mes_cours = $requette->fetch()){
	    		  					 	echo $mes_cours['vendredi'];}?></td>

	    		  				<td>&nbsp</td>

	    		  				<td><?php $requette=$bdd->prepare("SELECT DISTINCT * FROM planning_cours RIGHT JOIN mes_cours ON mes_cours.id_cours=planning_cours.id_cours WHERE mes_cours.id_personne=?");
	    		  			$requette->execute(array($getid));
	    		  					while($mes_cours = $requette->fetch()){
	    		  					 echo $mes_cours['samedi'];}?></td>

	    		  				<td>&nbsp</td>

	    		  				<td><?php $requette=$bdd->prepare("SELECT DISTINCT * FROM planning_cours RIGHT JOIN mes_cours ON mes_cours.id_cours=planning_cours.id_cours WHERE mes_cours.id_personne=?");
	    		  			$requette->execute(array($getid));
	    		  					while($mes_cours = $requette->fetch()){
	    		  					 echo $mes_cours['dimanche'];}?></td>
	    		  				    		  					
	    		  				</tr>
	    		  			</table>
	    		  			<?php
	    		  		
	    		  		?>						<br/ ><br/ >
	    		  		<a href ="#haut"><input type="submit" name="retour" class="retour"value="accueil" ></a>
	    		  	</div><br/><br/>
	    		  	<div id="techniques" class="techniques">
	    		  		<h1>Techniques SDB :</h1>
	    		  		<?php 
	    		  		$technique=$bdd->prepare("SELECT * FROM nos_techniques");
	    		  		$technique->execute(array());
	    		  		echo " voici la liste de nos techniques et leurs descriptions : </br></br>";
	    		  		while ( $nos_techniques=$technique->fetch()){
	    		  			echo "<strong>".$nos_techniques['nom_tech']."</strong></br>  dont la description est la suivante : ".$nos_techniques['description_tech']."</br> en video :   ".$nos_techniques['lien_video']."</br></br>";
	    		  		}
	    		  		?>		
	    		  	</br>
	    		  	<a href ="#haut"><input type="submit" name="retour"class="retour" value="accueil" ></a> 
	    		  </div><br/>	
	    		  <div id="mesEvents" class="mesEvents">
	    		  	<h1>Mes Evennements</h1><br/>			
	    		  	<table>
	    		  		<tr>
	    		  			<td>janvier</td>
	    		  			<td>fervier</td>
	    		  			<td>mars</td>
	    		  			<td>Avril</td>
	    		  			<td>Mai</td>
	    		  		</tr>
	    		  		<tr>
	    		  			<td>
	    		  		<?php $nosEvent=$bdd->prepare("SELECT DISTINCT janvier FROM planning_event");
	    		  		$nosEvent->execute(array());
	    		  		while	($Evennements=$nosEvent-> fetch()){
	    		  				echo $Evennements['janvier'];
	    		  			}	?>    		  		
	    		  			</td>				
	    		  			<td><?php $nosEvent=$bdd->prepare("SELECT DISTINCT fevrier FROM planning_event ");
	    		  		$nosEvent->execute(array());
	    		  		while	($Evennements=$nosEvent-> fetch()){
	    		  				echo $Evennements['fevrier'];
	    		  			}?>
	    		  				
	    		  			</td>
	    		  			<td><?php $nosEvent=$bdd->prepare("SELECT DISTINCT Mars FROM planning_event ");
	    		  		$nosEvent->execute(array());
	    		  		while	($Evennements=$nosEvent-> fetch()){
	    		  				echo $Evennements['Mars'];
	    		  			}?>	</td>
	    		  			<td><?php $nosEvent=$bdd->prepare("SELECT DISTINCT Avril FROM planning_event ");
	    		  		$nosEvent->execute(array());
	    		  		while	($Evennements=$nosEvent-> fetch()){
	    		  				echo $Evennements['Avril'];
	    		  			}?></td>
	    		  			<td>
	    		  				<?php $nosEvent=$bdd->prepare("SELECT DISTINCT Mai FROM planning_event ");
	    		  		$nosEvent->execute(array());
	    		  		while	($Evennements=$nosEvent-> fetch()){
	    		  				echo $Evennements['Mai'];
	    		  			}?>
	    		  				
	    		  			</td>
	    		  			<td></td>
	    		  		</tr>
	    		  		<tr>
	    		  			<td><?php $nosEvent=$bdd->prepare("SELECT DISTINCT type_event FROM evenements WHERE id_event=1 ");
	    		  		$nosEvent->execute(array());
	    		  		while	($Evennements=$nosEvent-> fetch()){
	    		  				echo $Evennements['type_event'];
	    		  			}?>
	    		  				</td>
	    		  			<td> </td>
	    		  			<td><?php $nosEvent=$bdd->prepare("SELECT DISTINCT type_event FROM evenements WHERE id_event=1");
	    		  		$nosEvent->execute(array());
	    		  		while	($Evennements=$nosEvent-> fetch()){
	    		  				echo $Evennements['type_event'];
	    		  			}?></td>
	    		  			<td><?php $nosEvent=$bdd->prepare("SELECT DISTINCT type_event FROM evenements WHERE id_event=2");
	    		  		$nosEvent->execute(array());
	    		  		while	($Evennements=$nosEvent-> fetch()){
	    		  				echo $Evennements['type_event'];
	    		  			}?></td>
	    		  			<td><?php $nosEvent=$bdd->prepare("SELECT DISTINCT type_event FROM evenements WHERE id_event=2 ");
	    		  		$nosEvent->execute(array());
	    		  		while	($Evennements=$nosEvent-> fetch()){
	    		  				echo $Evennements['type_event'];
	    		  			}?></td>

	    		  		</tr>
	    		  		<tr>
	    		  			<td>à partir de 18h</td>
	    		  			<td></td>
	    		  			<td>à partir de 19h</td>
	    		  			<td></td>
	    		  			<td>à partir de 10h</td>
	    		  		</tr>
	    		  	</table>
	    		  	<a href ="#haut"><input type="submit" name="retour" value="accueil" class="retour"></a>
	    		  </div><br/><br/>
	    		  <div id="mesEval" class="mesEval">
	    		  	<h1>Mes Evaluations :</h1>
	    		  	<p>Ok! ici on va rentrer dans la roda. Dans le dur! en fonction de ton niveau ( ta corde) tu trouveras tout ce que tu dois valider pour prétendre à la prochaine corde...</p>
	    		  	<p>J'ai déjà acquis les techniques ci dessous : </p>

	    		  	<?php 
	    		  	$myTech=$bdd->prepare("SELECT DISTINCT * FROM techniques_acquises WHERE id_personne=? GROUP BY nom_tech");
	    		  	$myTech->execute(array($userinfo['id_personne']));

	    		  	while ($myTechniques=$myTech->fetch()) {
	    		  		echo $myTechniques['nom_tech']."<br />";
	    		  	};
	    		  	?>
	    		  	<h1> Les prochaines techniques que je dois apprendre et valider :  </h1>
	    		  	<form id="formPage" class="formPage" action="" method="post">
	    		  		<?php
	    		  		$technique=$bdd->prepare("SELECT DISTINCT * FROM nos_techniques");
	    		  		$technique->execute(array());
	    		  		while ( $nos_techniques=$technique->fetch()){
	    		  			echo "<strong>".$nos_techniques['nom_tech']."</strong> &nbsp <input type=checkbox name=connais[] id=connais value=".$nos_techniques['id_tech']."> &nbsp".$nos_techniques['description_tech']."</br>";
	    		  		}
	    		  		?></br>

	    		  		<input type="submit" name="tech" class="retour" value="valider mes techniques">
	    		  	</form>
	    		  	<?php
	    		  	if(isset($_POST['tech'])){
	$choix=$_POST['connais']; //j enregistre chaque choix  dans une nouvelle variable 
	foreach ($choix as $techniques ){ // pour chaque choix je met à jour ma bdd uniquement les éléments cochés
		print_r ($techniques);
		$integrer=$bdd->prepare("INSERT INTO techniques_acquises ( id_personne,id_tech, login ) VALUES(?,?,?) ");
		$integrer->execute(array($userinfo['id_personne'],$techniques,$userinfo['login']));
		//$DejaAcquise = $integrer-> RowCount();
			
		$MAJ=$bdd->prepare("UPDATE techniques_acquises RIGHT JOIN nos_techniques ON techniques_acquises.id_tech = nos_techniques.id_tech SET techniques_acquises.nom_tech = nos_techniques.nom_tech WHERE id_personne=?");
		$MAJ->execute(array($userinfo['id_personne']));
		
			}
		}
		
	?></br>
	<a href ="#haut"><input type="submit" name="retour" class="retour"value="accueil" ></a>
</div></br>
<div id="call1" class="call1">                        
	 <form enctype="multipart/form-data" action="mailto:langdonronald@gmail.com" method="POST" id="ou" class="ou">
	 	<span><h2>Des Questions? Contactez nous.</h2></span>
                               <input type="text" name="nom" value="Nom" size="15">
                               <input type="text" name="prenon" value="Prénom" size="15"><br/><br/>
                               <input type="text" name="email" value="Email"size="37"><br/><br/>
                               <input type="text" name="objet" value="Objet du message" size="37"> <br/><br/>
                               <input type="text" name="message" value="Votre message" size="300"class="message"><br/><br/>
                               <button type="submit" id="envoyer" class="envoyer"
                               name="envoyer">envoyer</button>
                          </form> <br/>
	<a href ="#navbar"><input type="submit" name="retour" class="retour"
  value="accueil" ></a>
</div>

	<?php
	?>
	<?php
	include("C:\Wamp\www\suldabhaia\piedPage.php");
	?>
</body>
</html>
