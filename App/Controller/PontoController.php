<?php
require "./App/Model/PontoModel.php";

class PontoController // registrar a chegada dos funcionários no BD
{
    public function entrada(FuncionarioModel $funcionario){
        try {
            # Conexão com o BD
            $conn = new Connection();

            $pontoService = new PontoService($conn, $funcionario);
            return $pontoService->entrada();

        } catch (\Throwable $th) {
            return "Erro na entrada do funcionario";
        }
    }

    public function saida(FuncionarioModel $funcionario){ // registrar a saída dos funcionários
        try {
            $conn = new Connection();
            $pontoService = new PontoService($conn, $funcionario);
            return $pontoService->saida();

        } catch (\Throwable $th) {
            return "Erro na Saida do funcionario";
        }
    }

    public function delete($id){ // registrar a saída dos funcionários
        $conn = new Connection();

        $pontoService = new PontoService($conn);

        return $pontoService->deleteFuncionario($id);
    }
}