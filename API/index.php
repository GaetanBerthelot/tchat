<?php

header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// index.php

// Création de l'objet PDO qui représente la connexion à la BDD
require_once 'dbconnect.php';

// Chargement des modèles (classes) :
// - classes "mères"
require_once 'MODEL/model.class.php';
// - classes "filles"
require_once 'MODEL/UserModel.class.php';
require_once 'MODEL/MessageModel.class.php';

// Chargement des fonctions
//require_once 'functions/uuid_v5.php';

/*
	Chargement du fichier de routing (simplifié) :
	le routing consiste à savoir quelles vues afficher selon l'url qui est tapée
	Ex: index.php?menu=signup affichera 'view/signup.phtml' grâce à l'include 'view/' . $menu . '.phtml';
 */
//require_once 'routing.php';

/*
	On charge notre contrôleur (simplifié)
	qui permet d'utiliser les modèles (classes) pour :
	- récupérer des données à partir des modèles et les préparer pour nos vues
	- récupérer des données envoyées par les requêtes HTTP du client ($_GET et $_POST) pour les envoyer aux modèles
 */
require_once 'CONTROLLER/controller.php';

// Affichage de nos vues (templates)
//require_once 'view/top.phtml';
//require_once 'view/' . $menu . '.phtml';
//require_once 'view/bottom.phtml';

?>