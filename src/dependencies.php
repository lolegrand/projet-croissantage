<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

    // PDO
    $container['pdo'] = function ($container) {
        return \Src\Models\Database::getInstance();
    };
    // -----------------------------------------------------------------------------
    // Model factories
    // -----------------------------------------------------------------------------
    $container['cfgModel'] = function ($container) {
        $settings = $container->get('settings');
        $cfgModel = new Src\Models\ConfigurationModel($container->get('pdo'));
        return $cfgModel;
    };
    // -----------------------------------------------------------------------------
    // Controller factories
    // -----------------------------------------------------------------------------

    $container['Src\Controller\IndexController'] = function ($container) {
        $view = $container->get('renderer');
        $logger = $container->get('logger');
        return new Src\Controller\IndexController($view, $logger, $container);
    };


    $container['Src\Controller\StudentController'] = function ($container) {
        $view = $container->get('renderer');
        $logger = $container->get('logger');
        return new Src\Controller\StudentController($view, $logger, $container);
    };

    $container['Src\Controller\AdminController'] = function ($container) {
        $view = $container->get('renderer');
        $logger = $container->get('logger');
        return new Src\Controller\AdminController($view, $logger, $container);
    };

    $container['Src\Controller\CroissantageController'] = function ($container) {
        $view = $container->get('renderer');
        $logger = $container->get('logger');
        return new Src\Controller\CroissantageController($view, $logger, $container);
    };

    $container['Src\Controller\SystemController'] = function ($container) {
        $logger = $container->get('logger');
        $cfgModel = $container->get('cfgModel');
        // $cfgModel = $container->get('cfgModelFPDO');
        // $cfgModel = $container->get('cfgModelMock');
        return new Src\Controller\SystemController($logger, $cfgModel);
    };
};