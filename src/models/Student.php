<?php

namespace Src\Models;


class Student
{
    private $id;
    private $login;
    private $alias;
    private $pwd;
    private $pastry;
    private $roles = [];
    private $promotions = [];

    public function __construct($login, $alias, $pwd, PastryType $defaultPastry, $id=null)
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
            case 'roles' : return $this->roles;
            case 'promotions' : return $this->promotions;
        }
    }

    public function isAdmin() {
        foreach ($this->roles as &$role) {
            if ($role->role == 'Admin') {
                return true;
            }
        }
        return false;
    }

    public function isBDE() {
        foreach ($this->roles as &$role) {
            if ($role->role == 'BDE') {
                return true;
            }
        }
        return false;
    }

    public function isDelegue() {
        foreach ($this->roles as &$role) {
            if ($role->role == 'Delegue') {
                return true;
            }
        }
        return false;
    }

    public function __set($name, $value)
    {
        switch ($name)
        {
            case 'roles' : $this->roles = $value;break;
            case 'promotion' : $this->promotions = $value;break;
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
            $student = new Student($i->login, $i->alias, $i->pwd, PastryType::getById($i->defaultPastry), $i->id);
            $student->roles = Right::getRightsByStudentId($student->id);
            $student->promotions = Promo::getPromoByStudentId($student->id);
            $students[] = $student;
        }
        return $students;
    }

    public static function getById($id)
    {
        $db = Database::getInstance();
        $sth = $db->prepare("SELECT * FROM Student WHERE id=$id");
        $sth->execute();
        $data = $sth->fetchAll()[0];
        return new Student($data->login, $data->alias, $data->pwd, PastryType::getById($data->defaultPastry), $data->id);
    }

    public function registerToDatabase()
    {
        $request = "INSERT INTO Student(login, alias, pwd, defaultPastry) VALUES (\"$this->login\",\"$this->alias\",\"$this->pwd\",$this->pastry->id)";
        $sth = Database::getInstance()->prepare($request);
        $students = self::getAll();
        foreach ($students as &$student) {
            if ($student->login == $this->login && $student->pwd == $this->pwd) {
                return false;
            }
        }
        $sth->execute();
        return true;
    }

    public function setAlias($newAlias)
    {
        $this->alias = $newAlias;
        $request = "UPDATE Student SET alias=\"$this->alias\" WHERE id=$this->id";
        $sth = Database::getInstance()->prepare($request);
        $sth->execute();
    }

    public function setPastry(PastryType $pastryType)
    {
        $this->pastry = $pastryType;
        $pastryId = $this->pastry->id;
        $request = "UPDATE Student SET defaultPastry=$pastryId WHERE id=$this->id";
        $sth = Database::getInstance()->prepare($request);
        $sth->execute();
    }

}