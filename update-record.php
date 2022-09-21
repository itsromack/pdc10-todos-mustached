<?php

include "init.php";

$task = new Todo('');
$task->setConnection($connection);
$task->getById(1);
$task->update('Collect wood', 0);

var_dump($task);