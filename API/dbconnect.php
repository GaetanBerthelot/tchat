<?php

/***********************************/
/* CONNEXION A LA BASE DE DONNEES */
/***********************************/
/* dans cette classe je récupère un objet de type PDO, c'est à dire créé à partir de la classe PDO */
/* --> new PDO */


$eChat = "mysql:host=localhost;dbname=chat;charset=UTF8";

// dbconnect.php

try
{
	$PDO = new PDO($eChat, "3wa", "troiswa");
}
catch (PDOException $exceptionObject)
{
	echo 'Erreur de connection PDO (' . $exceptionObject->getCode() . '): ' . $exceptionObject->getMessage();

	exit();
}
