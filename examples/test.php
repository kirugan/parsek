<?php
spl_autoload_register(function($class){
    $path = __DIR__ . "/../src/{$class}.php";
    require_once $path;
});

$client = CurlHttpClientFactory::createInstance();
$content = $client->get('http://google.com');
echo $content;