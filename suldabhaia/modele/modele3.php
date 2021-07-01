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

?>
