<?php

class FuncionarioController
{
    private $connection;
    private $id;
    public function __construct($id = null)
    {
        $this->connection = new Connection(); // conexão com a tabela de funcionários
        $this->id = $id;
    }
    public function create($funcionario)
    {
        $funcionarioService = new FuncionarioService($this->connection, $funcionario);
        return $funcionarioService->createFuncionario();
    }
    public function getAllFuncionarios(){

        $funcionarioService = new FuncionarioService($this->connection);
        
        return $funcionarioService->getAllFuncionario();
    }
    public function getFuncionario()
    {
        
        $funcionario = new FuncionarioModel();

        $funcionario->__set('id',$this->id);

        $funcionarioService = new FuncionarioService($this->connection, $funcionario);
        
        return $funcionarioService->getFuncionario();
    }
    public function workTime()
    {
        
        $funcionario = new FuncionarioModel();

        $funcionario->__set('id',$this->id);

        $funcionarioService = new FuncionarioService($this->connection, $funcionario);
        $horario = new PontoService($this->connection, $funcionario);
        $horario = $horario->getHorarios();
        
        return $funcionarioService->getWorkTime($horario);
    }
}