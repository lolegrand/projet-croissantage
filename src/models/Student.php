<?php

namespace Src\Models;

class Student
{
    private $id;
    private $login;
    private $alias;
    private $pwd;
    private $pastryId;
    private $role;

    public function __construct($login, $alias, $pwd, $defaultPastry, $id=null)
    {
        $this->login = $login;
        $this->alias = $alias;
        $this->pwd = $pwd;
        $this->pastryId = $defaultPastry;
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
            case 'pastry' : return $this->pastryId;
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
            $students[] = new Student($i->login, $i->alias, $i->pwd, $i->defaultPastry, $i->id);
        }
        return $students;
    }

    public function registerToDatabase()
    {
        $requete = "INSERT INTO Student(login, alias, pwd, defaultPastry) VALUES (\"$this->login\",\"$this->alias\",\"$this->pwd\",$this->pastryId)";
        $sth = Database::getInstance()->prepare($requete);
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