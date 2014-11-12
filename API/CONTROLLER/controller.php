<?php
	
// API/CONTROLLER/controller.php


$users = new UserModel($PDO);
$messages = new MessageModel($PDO);


if (isset($_GET['action']) && $_GET['action'] === 'listUsers') {
	$listUsers = $users->listAll();
}


if (isset($_GET['action']) && $_GET['action'] === 'listMessages') {
	$listMessages = $messages->listAll();
}


if (isset($_GET['action']) && $_GET['action'] === "addUser" && isset($_GET['userNickname']))
{
	if ($userModel->exist($_GET['userNickname'])) 
	{
		http_response_code(208);
		return false;
		// echo json_encode($userModel->getIdByNickname)
	}

	else
	{
		http_response_code(201);
		$userModel->addUser($_GET['userNickname']);
		echo json_encode($userModel->getIdByNickname($_GET['userNickname']));
	}
}

?>