<?php

include "init.php";

use App\Todo;

$id = $_GET['id'];

$todo = new Todo('');
$todo->setConnection($connection);
$todo->getById($id);


echo $mustache->render('edit', compact('todo'));

