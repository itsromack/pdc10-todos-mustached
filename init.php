<?php

include "vendor/autoload.php";
include "config/database.php";

use App\Connection;
use App\Todo;

$connObj = new Connection($host, $database, $user, $password);
$connection = $connObj->connect();

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates')
]);
