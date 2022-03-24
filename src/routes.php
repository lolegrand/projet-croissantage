<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->post('/', 'Src\Controller\IndexController:postIndex')
        ->setName('login');

    $app->get('/', 'Src\Controller\IndexController:getIndex')
    ->setName('index');

    $app->get('/student', 'Src\Controller\StudentController:getStudent')
        ->setName('index');

    $app->post('/student', 'Src\Controller\StudentController:postStudent')
        ->setName('index');
};
