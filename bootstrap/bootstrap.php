<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();


$app->addErrorMiddleware(true,true,true);

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write('Hello slim');
    return $response;
});

$app->run();

