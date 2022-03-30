<?php

namespace Src\Models;

class PastryCommandItem
{
    private $nbPastry;
    private $pastryType;

    public function __construct($nbPastry, $pastryType)
    {
        $this->nbPastry = $nbPastry;
        $this->pastryType = $pastryType;
    }

    public function __get($name)
    {
        switch ($name)
        {
            case 'nbPastry' : return $this->nbPastry;
            case 'pastryType' : return $this->pastryType;
        }
    }

    public static function getPastryCommandItemByCroissantageId($id)
    {
        $db = Database::getInstance();
        $sth = $db->prepare("SELECT * FROM PastryCommandItems WHERE idC=$id");
        $sth->execute();
        $dataArray = $sth->fetchAll();
        $pastryCommandItems = [];
        foreach ($dataArray as &$item)
        {
            $pastryCommandItems[] = new PastryCommandItem($item->nb, PastryType::getById($item->idType));
        }
        return $pastryCommandItems;
    }


}