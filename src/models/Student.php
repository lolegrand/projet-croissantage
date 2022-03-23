<?php

namespace Src\Models;

class Student
{
    private $id;
    private $login;
    private $alias;
    private $pwd;
    private $pastry;
    private $role;

    public function __construct($login, $alias, $pwd, $defaultPastry, $id=null)
    {
        $this->login = $login;
        $this->alias = $alias;
        $this->pwd = $pwd;
        $this->pastry = $defaultPastry;
        $this->id = $id;
    }

    public function __get($name)
    {
        switch ($name)
        {
            case 'id' : return $this->id;
            case 'login' : return $this->login;
            case 'alias' : return $this->alias;
            case 'pwd' : return $this->pwd;
            case 'pastry' : return $this->pastry;
        }
    }

    public static function getAll()
    {
        $db = Database::getInstance();
        $sth = $db->prepare("SELECT * FROM Student");
        $sth->execute();
        $dataArray = $sth->fetchAll();
        $students = [];
        foreach ($dataArray as &$i) {
            /*TODO fetch role for this student*/
            $students[] = new Student($i->login, $i->alias, $i->pdw, $i->defaultPastry, $i->id);
        }
        return $students;
    }

    public function registerToDatabase()
    {
        $sth = Database::getInstance()->prepare("INSERT INTO Student(login, alias, pwd) VALUES (".$this->login.",".$this->alias.",".$this->pwd.")");
        $students = self::getAll();
        foreach ($students as &$student) {
            if ($student->login == $this->login && $student->pwd == $this->pwd) {
                return false;
            }
        }
        $sth->execute();
        return true;
    }

}