<?php

use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


return function (App $app) {

    //ROUTES 
    
    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write('Hello slim');
        return $response;
    });
};