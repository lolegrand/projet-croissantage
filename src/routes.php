<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->post('/', 'Src\Controller\IndexController:form')
        ->setName('login');

    $app->get('/', 'Src\Controller\IndexController:index')
    ->setName('index');
};
