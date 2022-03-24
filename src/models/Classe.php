<?php

namespace Src\Models;

class Classe
{
    private $id;
    private $name;


    public function __construct($name, $id=null)
    {
        $this->id = $id;
        $this->name = $name;
    }


    public function __get($name)
    {
        switch ($name)
        {
            case 'name' : return $this->name;
        }
    }
}