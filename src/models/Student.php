<?php

namespace Src\Models;

class Student extends BaseModel
{
    private $id;
    private $login;
    private $alias;
    private $pwd;
    private $defaultPastry;
    private $role;

    public function __get($name)
    {
        switch ($name)
        {
            case 'id' : return $this->id;
            case 'login' : return $this->login;
            case 'alias' : return $this->alias;
            case 'pwd' : return $this->pwd;
        }
    }

    public function __construct($db)
    {
        parent::__construct($db);
    }

    public static function getAll($db)
    {
        $sth = $db->prepare("SELECT * FROM Student");
        $sth->execute();
        $dataArray = $sth->fetchAll();
        $students = [];
        foreach ($dataArray as &$i) {
            $item = new Student($db);
            $item->id = $i->id;
            $item->alias = $i->alias;
            $item->login = $i->login;
            $item->pwd = $i->pwd;
            /*TODO fetch role for this student*/
            $students[] = $item;
        }
        return $students;
    }

    public static function registerStudent($db, $student)
    {
        $sth = $db->prepare("INSERT INTO Student(login, alias, pwd) VALUES (".$student->login.",".$student->alias.",".$student->pwd.")");
        $sth->execute();
    }

}