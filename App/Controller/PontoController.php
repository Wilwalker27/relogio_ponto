<?php
require "./App/Model/PontoModel.php";

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

        $pontoService = new PontoService($conn, $funcionario);

        return $pontoService->saida();
    }
}