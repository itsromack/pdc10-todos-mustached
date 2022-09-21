<?php

include "init.php";

use App\Todo;


$task_id = $_POST['id'];
$task_description = $_POST['task'];

$task = new Todo('');
$task->setConnection($connection);
$task->getById($task_id);
$task->update($task_description, 0);

header("Location: list-records.php");
