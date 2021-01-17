<?php

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Psr\Http\Message\ResponseInterface as Response;


//GLOBAL FUNCTIONS


if (!function_exists('dd'))
{
    /**
     * die and var_dump 
     *
     * @return void
     */
    function dd()
    {
        array_map(function ($content) {
            echo "<pre>";
            var_dump($content);
            echo "</pre>";
            echo "<hr>";
        }, func_get_args());

        die;
    }
}

if(!function_exists('view')) {
    /**
     * view renderer
     *
     * @param Response $response
     * @param string $view 
     * @param array|null $vars
     * @return Response
     */
    function view(Response $response, string $view,?array $vars = []):Response {

        //load twig filesystem
        $dir = dirname(dirname(__DIR__)) . '/views';
        $loader = new Filesystemloader($dir);
        $twig = new Environment($loader);

        $view = str_replace('.', DIRECTORY_SEPARATOR,$view) . '.html.twig';
        $file = $dir . DIRECTORY_SEPARATOR . $view;

        if(file_exists($file)) {
            $response->getBody()->write($twig->render($view,$vars));
            return $response;
        } else {
            throw new Exception('VIEWRENDERERException: cannot find ' . $view);
        }
    }
}