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

if(!function_exists('base_path')) {

    function base_path(string $path = '') {
        return dirname(__DIR__,2) . DIRECTORY_SEPARATOR . $path;
    }
}

if(!function_exists('view_path')) {

    function view_path(string $path = '') {
        return base_path('views') . DIRECTORY_SEPARATOR . $path;
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
        $dir = view_path();
        $loader = new Filesystemloader($dir);
        $twig = new Environment($loader,[
            'cache' => base_path('cache')
        ]);

        $view = str_replace('.', DIRECTORY_SEPARATOR,$view) . '.html.twig';
        $file = $dir . DIRECTORY_SEPARATOR . $view;

        if(file_exists($file)) {
            $response->getBody()->write($twig->render($view,$vars));
            return $response;
        } else {
            throw new \Exception('VIEW_RENDERER_Exception: cannot find ' . $view);
        }
    }
}