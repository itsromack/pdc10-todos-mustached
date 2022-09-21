<?php

include "init.php";

use App\Todo;

$task = new Todo('');
$task->setConnection($connection);
$todos = $task->getAll();

// One-liner to display content
// echo $mustache->render('list', compact('todos'));

// Another way
$template = $mustache->loadTemplate('list');
echo $template->render(compact('todos'));