<?php
class PontoModel
{
    private int $id;
    private int $id_funcionario;
    private $horarioEntrada;
    private $horarioSaida;

    public function __get($attr)
    {
        return $this->$attr;
    }
    public function __set($attr, $value) 
    {
        $this->$attr = $value;
    }
}