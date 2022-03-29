<?php

namespace Src\Models;

use function PHPUnit\Framework\isEmpty;

class PastryType
{
    private $id;
    private $name;
    private $isAvailable;

    public function __get($name)
    {
        switch ($name) {
            case 'id': return $this->id;
            case 'name': return $this->name;
            case 'isAvailable': return $this->isAvailable;
        }
    }

    public function __construct($name, $isAvailable, $id=null)
    {
        $this->name = $name;
        $this->isAvailable = $isAvailable;
        $this->id = $id;
    }

    public static function getAll()
    {
        $db = Database::getInstance();
        $sth = $db->prepare("SELECT * FROM PastryType");
        $sth->execute();
        $dataArray = $sth->fetchAll();
        $pastries = [];
        foreach ($dataArray as &$i) {
            $pastries[] = new PastryType($i->name,$i->isAvailable,$i->id);
        }
        return $pastries;
    }

    public static function getById($id)
    {
        if ($id == null) {
            $id = 1; // I suppose the croissant as the default pastry.
        }
        $db = Database::getInstance();
        $sth = $db->prepare("SELECT * FROM PastryType WHERE id=$id");
        $sth->execute();
        $data = $sth->fetchAll();
        return new PastryType($data[0]->name, $data[0]->isAvailable, $data[0]->id);
    }

}