<?php
require './App/Database/Connection.php';
require "./App/Model/PontoModel.php";
require "./App/Model/FuncionarioModel.php";
require "./App/Services/PontoService.php";

class PontoController
{
    public function entrada(FuncionarioModel $funcionario){
        try {
            # Conexao com o bd
            $conn = new Connection();

            $pontoService = new PontoService($conn, $funcionario);
            return $pontoService->entrada();

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function saida(FuncionarioModel $funcionario){
        $conn = new Connection();

        return 'saida';
    }
}