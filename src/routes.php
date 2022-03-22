<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/a/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    $app->get('/login', function (Request $request, Response $response) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/login' route");

        // Render index view
        return $container->get('renderer')->render($response, 'adminLTE_login.phtml');
    });

    $app->get('/hello', function (Request $request, Response $response) use ($container) {

        return $container->get('renderer')->render($response, 'hello.html');
    });

    $app->get('/', 'Src\Controller\IndexController:index')
    ->setName('index');
};
