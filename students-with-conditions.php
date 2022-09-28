<?php

include "vendor/autoload.php";

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates')
]);

$students = [
    [
        "name" => "Karylle",
        "gender" => "Female"
    ],
    [
        "name" => "Jesel",
        "gender" => "Male"
    ],
    [
        "name" => "Calvin Kent",
        "gender" => "Male"
    ],
    [
        "name" => "Aki",
        "gender" => "Male"
    ],
    [
        "name" => "Ron Russelle",
        "gender" => "Male"
    ],
    [
        "name" => "Stephanie",
        "gender" => "Female"
    ],
    [
        "name" => "Ryan Matthew",
        "gender" => "Male"
    ]
];

$template = $mustache->loadTemplate('students2');
echo $template->render(compact('students'));