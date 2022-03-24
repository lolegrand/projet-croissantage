<?php

namespace Src\Controller;

use phpDocumentor\Reflection\Types\True_;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Src\Models\PastryType;
use Src\Models\Student;

final class StudentController extends BaseController
{

    public function getStudent(Request $request, Response $response, $args)
    {
        session_start();
        if (isset($_SESSION["student"]))
        {
            $outputArray = [];
            $outputArray['student'] = $_SESSION["student"];
            $outputArray['editAlias'] = 'valueAliasMode';
            $outputArray['editPastry'] = 'valuePastryMode';
            $this->view->render($response, 'student.phtml', $outputArray);
        } else {
            header('Location: http://'.$_SERVER['HTTP_HOST']);
            exit;
        }
    }

    public function postStudent(Request $request, Response $response, $args)
    {
        $outputArray = [];
        $outputArray['editAlias'] = 'valueAliasMode';
        $outputArray['editPastry'] = 'valuePastryMode';
        if ( isset($_POST['editAlias']) )
        {
            $outputArray['editAlias'] = $this->computeAliasEditing($_POST['editAlias']);
        }

        if ( isset($_POST['editPastry']))
        {
            $outputArray['editPastry'] = $this->computePastryEditing($_POST['editPastry']);
            if ($outputArray['editPastry'] == 'editPastryMode')
            {
                $outputArray['pastries'] = PastryType::getAll();
            }
        }

        $outputArray['student'] = $_SESSION["student"];
        print_r($outputArray);
        $this->view->render($response, 'student.phtml',$outputArray);
        return $response;
    }

    private function computeAliasEditing($editAliasValue)
    {
        switch ($editAliasValue)
        {
            case 'edit' : return 'editAliasMode';
            case 'cancel' : return 'valueAliasMode';
            case 'validate' : {
                $student = $_SESSION["student"];
                $student->setAlias($_POST['aliasInput']);
                $_SESSION["student"] = $student;
                return 'valueAliasMode';
            }
            default : return 'valueAliasModeWithError';
        }
    }

    private function computePastryEditing($editPastryValue)
    {
        switch ($editPastryValue)
        {
            case 'edit' : return 'editPastryMode';
            case 'cancel' : return 'valuePastryMode';
            case 'validate' : {
                $student = $_SESSION["student"];
                $student->setPastry(PastryType::getById($_POST['pastryInput']));
                $_SESSION["student"] = $student;
                return 'valuePastryMode';
            }
            default : return 'valuePastryModeWithError';
        }
    }

}