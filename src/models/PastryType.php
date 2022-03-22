<?php

namespace Src\Models;

class PastryType extends BaseModel
{
    private $id;
    private $name;
    private $isAvailable;

    public function __get($name)
    {
        return $this->name;
    }

    public static function getAll($db) {
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