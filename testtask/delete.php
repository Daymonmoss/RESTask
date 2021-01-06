<?php

$ids = [];

if(isset($_GET['user_id'])) {
	$ids[] = (int) $_GET['user_id'];
}
if(isset($_POST['users_ids']) and is_array($_POST['users_ids'])) {
	foreach($_POST['users_ids'] as $id) {
		$ids[] = (int) $id;
	}
}

if($ids) {
	require 'model.php';
	deleteUsers($ids);
}

header('Location: index.php');