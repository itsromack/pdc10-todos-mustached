<?php

include "init.php";

$task = new Todo('');
$task->setConnection($connection);
$todos = $task->getAll();

foreach ($todos as $item) {
	echo $item['task'] . ' is_completed=' . $item['is_completed'] . "\n";
}