<?php
namespace Src\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Src\Models\PastryType;
use Src\Models\Student;

final class IndexController extends BaseController
{
    public function index(Request $request, Response $response, $args)
    {
        $pastries = PastryType::getAll($this->container->get('pdo'));
        $this->view->render($response, 'index.phtml', ["pastries" => $pastries]);
        return $response;
    }

    public function form(Request $request, Response $response, $args) {
        if ($_POST['submit'] == 'login') {
            return $this->login($response);
        } else {
            return $this->register($response);
        }
    }

    private function register(Response $response)
    {

        return $response;
    }

    private function login(Response $response)
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $students = Student::getAll($this->container->get('pdo'));
        foreach ($students as $student) {
            if ( ($login == $student->login || $login == $student->alias) && $password == $student->pwd) {
                $this->view->render($response, 'login.phtml', ["name" => $login]);
                return $response;
            }
        }

        $this->view->render($response, 'login.phtml', ["name" => "Salope"]);
        return $response;
    }
}