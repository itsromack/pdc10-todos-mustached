<?php

include "vendor/autoload.php";

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates')
]);

$topicOne = [
    [
        "title" => "Advanced Web Application Development",
        "author" => "John Doe"
    ]
];

$topicTwo = [
    [
        "title" => "Philosophy",
        "author" => "Plato"
    ]
];

$template = $mustache->loadTemplate('page');

$output = $template->render(compact(
    'topicOne',
    'topicTwo'
));

echo $output;