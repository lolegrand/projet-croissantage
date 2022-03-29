<?php

namespace Src\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class AdminController extends BaseController
{
    public function getAdmin(Request $request, Response $response, $args)
    {
        if ( !isset($_SESSION['student'] )) {
            header('Location: http://'.$_SERVER['HTTP_HOST']);
            exit;
        }
        $outputArray = [];
        $outputArray['student'] = $_SESSION["student"];
        $this->view->render($response, 'admin.phtml', $outputArray);
        return $response;
    }

    public function postAdmin(Request $request, Response $response, $args) {
        return $response;
    }
}