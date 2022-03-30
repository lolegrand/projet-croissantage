<?php

namespace Src\Models;

class Croissantage
{
    private $id;
    private $croissantedStudent;
    private $croissanter;
    private $dateCroissantage;
    private $dateCommand;
    private $deadline;
    private $pastryCommandItem = [];

    public function __construct($croissantedStudent,
                                $croissanter,
                                $dateCommand,
                                $dateCroissantage,
                                $deadline,
                                $pastryCommandItem,
                                $id=null)
    {
        $this->id = $id;
        $this->pastryCommandItem = $pastryCommandItem;
        $this->deadline = $deadline;
        $this->dateCroissantage = $dateCroissantage;
        $this->dateCommand = $dateCommand;
        $this->croissanter = $croissanter;
        $this->croissantedStudent = $croissantedStudent;
    }

    public function __get($name)
    {
        switch ($name)
        {
            case "croissanted_student": return $this->croissantedStudent;
            case "croissanter": return $this->croissanter;
            case "dateCommand": return $this->dateCommand;
            case "deadline": return $this->deadline;
            case "dateCroissantage": return $this->dateCroissantage;
            case "pastryCommandItem": return $this->pastryCommandItem;
            case "id" : return $this->id;
        }
    }

    public static function getAll()
    {
        $db = Database::getInstance();
        $sth = $db->prepare("SELECT * FROM Croissantage");
        $sth->execute();
        $dataArray = $sth->fetchAll();
        $croissantages = [];
        foreach ($dataArray as &$item)
        {
            $croissantages[] = new Croissantage(
                Student::getById($item->idCed),
                Student::getById($item->idCer),
                $item->dateCommand,
                $item->dateC,
                $item->deadline,
                PastryCommandItem::getPastryCommandItemByCroissantageId($item->id),
                $item->id
            );
        }
        return $croissantages;
    }


}