<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $app->post('/', 'Src\Controller\IndexController:postIndex')
        ->setName('login');

    $app->get('/', 'Src\Controller\IndexController:getIndex')
    ->setName('login');

    $app->get('/student', 'Src\Controller\StudentController:getStudent')
        ->setName('student');

    $app->post('/student', 'Src\Controller\StudentController:postStudent')
        ->setName('student');

    $app->get('/admin', 'Src\Controller\AdminController:getAdmin')
        ->setName('admin');

    $app->post('/admin', 'Src\Controller\AdminController:postAdmin')
        ->setName('admin');

    $app->get('/croissantage', 'Src\Controller\CroissantageController:getCroissantage')
        ->setName('croissantage');

    $app->post('/croissantage', 'Src\Controller\CroissantageController:postCroissantage')
        ->setName('croissantage');

};
