<?php

include "init.php";

$task = new Todo('Clean the house');
$task->setConnection($connection);
$task->save();