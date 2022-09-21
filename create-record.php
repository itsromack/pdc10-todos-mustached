<?php

include "init.php";

use App\Todo;

if (!isset($_POST['task'])) {
	exit('Invalid request');
}

$task_description = $_POST['task'];

$task = new Todo($task_description);
$task->setConnection($connection);
$result = $task->save();

if (!is_null($result)) {
	header('Location: list-records.php');
} else {
	exit('Something went wrong, please contact your administrator');
}