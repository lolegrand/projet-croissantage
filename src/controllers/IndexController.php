<?php
namespace Src\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Src\Models\PastryType;
use Src\Models\Student;

final class IndexController extends BaseController
{
    private static $modelPastries = null;


    public function getIndex(Request $request, Response $response, $args)
    {
        $pastries = PastryType::getAll();
        $this->view->render($response, 'index.phtml', ["pastries" => $pastries]);
        return $response;
    }

    public function postIndex(Request $request, Response $response, $args) {
        if ($_POST['submit'] == 'Login') {
            return $this->login($response);
        } else {
            return $this->register($response);
        }
    }

    private function register(Response $response)
    {
        $student = new Student($_POST['login'], $_POST['alias'], $_POST['pwd'], $_POST['pastry']);
        $pastries = PastryType::getAll();
        $ret = $student->registerToDatabase();
        if (!$ret) {
            $this->view->render($response, 'index.phtml', ["pastries" => $pastries, "registerError" => $ret]);
        }
        return $response;
    }

    private function login(Response $response)
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $students = Student::getAll();
        foreach ($students as $student) {
            if ( $login == $student->login && $password == $student->pwd) {
                $this->view->render($response, 'login.phtml', ["name" => $login]);
                return $response;
            }
        }
        $this->view->render($response, 'login.phtml', ["name" => "Error"]);
        return $response;
    }
}