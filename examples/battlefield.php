<?php
require_once __DIR__ . '/../config/autoload.php';

$client = CurlHttpClientFactory::createInstance();

$content = $client->get('http://yandex.ru');
echo $client->getResponseCode();