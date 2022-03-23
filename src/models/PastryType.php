<?php

namespace Src\Models;

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

    public static function getAll() {
        $db = Database::getInstance();
        $sth = $db->prepare("SELECT * FROM PastryType");
        $sth->execute();
        $dataArray = $sth->fetchAll();
        $pastries = [];
        foreach ($dataArray as &$i) {
            $item = new PastryType($db);
            $item->id = $i->id;
            $item->name = $i->name;
            $item->isAvailable = $i->isAvailable;
            $pastries[] = $item;
        }
        return $pastries;
    }


}