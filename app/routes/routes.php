<?php

use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


return function (App $app) {

    //ROUTES 
    
    //basic hello world route 
    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write('Hello slim');
        return $response;
    });

    //basic view exemple route
    $app->get('/example', function (Request $request, Response $response, $args) {
        return view($response,'pages.example',['name' => 'Twig']);
    });
};