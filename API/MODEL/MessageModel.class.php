<?php
 // API/MODEL/MessageModel.class.php

/*
** Classe permettant de gérer les messages
*/

class MessageModel extends Model
{
	/*
	** Récupère la liste des utilisateurs dans un tableau à deux dimensions.
	*/

	public function listAll()
	{
		// On prépare notre requête SQL pour récupérer les messages
		$query = 'SELECT * FROM messages ORDER BY messageDate DESC';

		// On charge notre requête dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

		// On exécute notre requête SQL
		$statement->execute();

		// On retourne nos résultats sous un tableau à deux dimensions
		echo json_encode($statement->fetchAll());
	}

	/*
	** 	Ajoute nouveau message à la BDD
	*/

	public function addMessage ($messageValue, $messageDate, $userId)
	{
		// On passe le surnom des utilisateurs en miniscules pour éviter toute confusion dans les contrôles
		$messageValue = strtolower($messageValue);

		// On prépare notre requête SQL
		$query = 'INSERT INTO messages (messageValue, messageDate) AND users (userId) VALUES (:messageValue, :messageDate, :userId)';

		// On prépare notre tableau "binding" entre les valeurs de nos variables et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
		$boundValues = [
			'messageValue' => $messageValue,
			'messageDate' => $messageDate,
			'userId' => $userId
		];

		// On charge notre requête SQL dans la couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

		// On exécute notre requête SQL (en liant notre tableau de "binding")
		$statement->execute($boundValues);
	}

	/*
	** On supprime un utilisateur de la BDD
	*/

	public function remove ($messageId)
	{
		// On prépare notre requête SQL
		$query = 'DELETE FROM messages WHERE messageId = :messageId';

		// Tableau de binding
		$boundValues = [
			'messageId' => $messageId,
		];

		// Requête dans couche d'abstraction PDO
		$statement = $this->PDO->prepare($query);

		// On exécute notre requête SQL (en liant notre tableau de binding)
		$statement->execute($boundValues);
	}

	public function exists($messageId)
	{
		// On prépare notre requête SQL
		$query = "SELECT * FROM messages WHERE messageId = :messageId";

		// tableau de binding
		$boundValues = [
			'messageId' => $messageId,
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