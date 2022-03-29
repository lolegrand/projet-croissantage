<?php

namespace Src\Models;

class Right
{
    private $id;
    private $role;

    public function __get($name)
    {
        switch ($name)
        {
            case 'id' : return $this->id;
            case 'role' : return $this->role;
        }
    }

    public function __construct($role, $id=null)
    {
        $this->id = $id;
        $this->role = $role;
    }

    public static function getRightsByStudentId($idStudent)
    {
        $db = Database::getInstance();
        $sth = $db->prepare("SELECT * FROM Rights WHERE idS=$idStudent");
        $sth->execute();
        $dataArray = $sth->fetchAll();
        $rights = [];
        foreach ($dataArray as &$j) {
            $rights[] = new Right($j->role,$j->id);
        }
        return $rights;
    }

    public static function removeRights($id)
    {
        $db = Database::getInstance();
        $sth = $db->prepare("DELETE FROM `Rights` WHERE id=$id");
        $sth->execute();
    }

    public function addRight($studentId)
    {
        $db = Database::getInstance();
        $sth = $db->prepare("INSERT INTO `Rights`(`idS`, `role`) VALUES ($studentId,\"$this->role\")");
        $sth->execute();
    }

}