<?php

include "init.php";

use App\Todo;

$faker = Faker\Factory::create();

$i = 0;
while ($i++ < 30) {
	$task = new Todo($faker->sentence(), rand(0, 1));
	$task->setConnection($connection);
	$task->save();
	var_dump($task);
}
	