<?php

namespace Src\Models;

use phpDocumentor\Reflection\Types\Integer;

class Promo
{
    private $id;
    private $year;
    private $classe;

    public function __get($name)
    {
        switch ($name)
        {
            case 'id' : return $this->id;
            case 'year' : return $this->year;
            case 'classe' : return $this->classe;
        }
    }

    public function __construct($year, Classe $classe, $id=null)
    {
        $this->id = $id;
        $this->year = $year;
        $this->classe = $classe;
    }

    public static function getPromoByStudentId($idStudent)
    {
        $db = Database::getInstance();
        $sth = $db->prepare("SELECT * FROM Promo WHERE idStudent=$idStudent");
        $sth->execute();
        $dataArray = $sth->fetchAll();
        $promos = [];
        foreach ($dataArray as &$i) {
            $sth = $db->prepare("SELECT * FROM Class WHERE id=$i->idClass");
            $sth->execute();
            $data = $sth->fetchAll();
            $promos[] = new Promo($i->year, new Classe($data[0]->name,$data[0]->id), $i->id);
        }
        return $promos;
    }
}