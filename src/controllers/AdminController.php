<?php

namespace Src\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Models\PastryType;
use Src\Models\Student;

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
        $outputArray['allStudent'] = Student::getAll();
        $outputArray['pastries'] = PastryType::getAll();
        $this->view->render($response, 'admin.phtml', $outputArray);
        return $response;
    }

    public function postAdmin(Request $request, Response $response, $args) {
        return $response;
    }
}