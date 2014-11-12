<?php
 // API/MODEL/UserModel.class.php

/*
** Classe permettant de gérer les utilisateurs
*/

class UserModel extends Model
{
	/*
	** Récupère la liste des utilisateurs dans un tableau à deux dimensions.
	*/

	public function listAll()
	{
		// On prépare notre requête SQL
		$query = 'SELECT * FROM users ORDER BY userNickname';

		// On charge notre requête dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

		// On exécute notre requête SQL
		$statement->execute();

		// On retourne nos résultats sous un tableau à deux dimensions
		echo json_encode($statement->fetchAll());
	}

	/*
	** 	Ajoute nouvelle utilisateur à la BDD
	*/

	public function addUser ($userNickname)
	{
		$boundValues = [
			$userNickname = $_GET['userNickname']
		];

		$query = 'SELECT * FROM users ORDER BY userNickname';

		$statement = $this->PDO->prepare($query);

		$statement->execute($boundValues);

		echo json_encode($statement->fetchAll());

		if ($statement->rowCount() > 0) {
			return false;
		}

		else{
		// On passe le surnom des utilisateurs en miniscules pour éviter toute confusion dans les contrôles
		$userNickname = strtolower($userNickname);

		// On prépare notre requête SQL
		$query = 'INSERT INTO users(userNickname) VALUES (:userNickname)';

		// On prépare notre tableau "binding" entre les valeurs de nos variables et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
		$boundValues = [
			'userNickname' => $userNickname,
		];

		// On charge notre requête SQL dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

		// On exécute notre requête SQL (en liant notre tableau de "binding")
		$statement->execute($boundValues);

		echo json_encode($statement->addUser());
		}

	}

	/*
	** On supprime un utilisateur de la BDD
	*/

	public function remove ($userId)
	{
		// On prépare notre requête SQL
		$query = 'DELETE FROM users WHERE userId = :userId';

		// Tableau de binding
		$boundValues = [
			'userId' => $userId,
		];

		// Requête dans couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

		// On exécute notre requête SQL (en liant notre tableau de binding)
		$statement->execute($boundValues);
	}

	public function exists($userId)
	{
		// On prépare notre requête SQL
		$query = "SELECT * FROM users WHERE userId = :userId";

		// tableau de binding
		$boundValues = [
			'userId' => $userId,
		];

		// Requête dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

		// On exécute notre requête SQL (en liant notre tableau de binding)
		$statement->execute($boundValues);

		// S'il n'y a aucun enregistrement dans la BDD
		if ($statement->rowCount() === 0) {
			// On retourne la valeur FALSE
			return false;
		}
		// Sinon (s'il n'y a aucun enregistrement)
		else
		{
			// On retourne la valeur TRUE
			return true;
		}
	}



}