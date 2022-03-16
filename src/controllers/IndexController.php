<?php
namespace Src\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class IndexController extends BaseController
{
    public function index(Request $request, Response $response, $args)
    {
        $this->logger->info("Index action dispatched");
        /*$db = $this->container->get('pdo');
        $db->prepare("SELECT * FROM Student");
        $db->execute();
        $rcCfgs = $db->fetchAll();*/
        //$this->view->render($response, 'adminLTE.phtml', ["name" => json_encode($rcCfgs)]);
        $this->view->render($response, 'adminLTE.phtml', ["name" => "moi"]);
        return $response;
    }
}