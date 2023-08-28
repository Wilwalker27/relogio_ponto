<?php

class FuncionarioModel
{
    private $id;
    private $name;
    private $isWorking;

    public function __get($attr)
    {
        return $this->$attr;
    }
    public function __set($attr, $value) 
    {
        $this->$attr = $value;
    }
}