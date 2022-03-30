<?php

namespace Src\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Models\Croissantage;

final class CroissantageController extends BaseController
{

    public function getCroissantage(Request $request, Response $response, $args)
    {
        if ( !isset($_SESSION['student'])) {
            header('Location: http://'.$_SERVER['HTTP_HOST']);
            exit;
        }
        $outputArray = [];
        $outputArray['student'] = $_SESSION['student'];
        $outputArray['croissantages'] = Croissantage::getAll();
        $this->view->render($response, 'croissantage.phtml', $outputArray);
        return $response;
    }

    public function postCroissantage(Request $request, Response $response, $args)
    {
        if ( !isset($_SESSION['student'] )) {
            header('Location: http://'.$_SERVER['HTTP_HOST']);
            exit;
        }



        return $response;
    }




}