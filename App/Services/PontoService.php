<?php
require './App/Services/FuncionarioService.php';

class PontoService
{
    private $connection;
    private $funcionario;
    private $funcionarioService;

    public function __construct(Connection $conn, FuncionarioModel $funcionario)
    {
        $this->connection = $conn->connect();
        $this->funcionarioService = new FuncionarioService($conn, $funcionario);
        $this->funcionario = $this->funcionarioService->getFuncionario();
    }

    public function getHorarios()
    {
        try {
            $id_funcionario = $this->funcionario->id;
            $query = '
                    SELECT 
                        *
                    FROM
                        pontos
                    WHERE
                        id_funcionario = :id_funcionario
                    ORDER BY
                        horario_entrada
                            DESC
                ';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':id_funcionario', $id_funcionario);
            $stmt->execute();
            $horarios = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            if(!empty($horarios)){
                return $horarios;
            }else {
                throw new Exception("Usuário não existe");
            }
        } catch (\Throwable $th) {
            return "Erro ao recuperar os horarios";
        }
    }

    public function entrada()
    {
        if (!$this->funcionario->is_working) {
            try {
                $id_funcionario = $this->funcionario->id;
                $query = '
                    INSERT INTO 
                        pontos(id_funcionario, horario_entrada)
                    VALUES(:id_funcionario, :horario_entrada)
                ';
                $stmt = $this->connection->prepare($query);
                $stmt->bindValue(':id_funcionario', $id_funcionario);
                $stmt->bindValue(':horario_entrada', date('Y-m-d H:i:s'));
                $stmt->execute();
                $this->funcionarioService->changeIsWorking();
                $this->funcionario->is_working = 1;
                return 'O funcionário entrou na empresa';
                //return 'O funcionario entrou na empresa!';
            } catch (\Throwable $th) {
                return "Aconteceu um erro ao recuperar o funcionário";
            }
        } else{
            return 'O funcionário já esta na empresa';
        }

    }

    public function saida()
    {
        if ($this->funcionario->is_working) {
            try {
                $id_funcionario = $this->funcionario->id;
                $query = '
                        SELECT 
                            *
                        FROM
                            pontos
                        WHERE
                            id_funcionario = :id_funcionario
                        ORDER BY
                            horario_entrada
                                DESC
                    ';
                $stmt = $this->connection->prepare($query);
                $stmt->bindValue(':id_funcionario', $id_funcionario);
                $stmt->execute();
                $usuarioExistente = $stmt->fetch(PDO::FETCH_OBJ);
                
                if(empty($usuarioExistente->horario_saida)){
                    try {
                        $query = '
                            UPDATE 
                                pontos
                            SET 
                                horario_saida = :horario_saida
                            WHERE 
                                id = :id 
                        ';
                        $stmt = $this->connection->prepare($query);
                        $stmt->bindValue(':horario_saida', date('Y-m-d H:i:s'));
                        $stmt->bindValue(':id', $usuarioExistente->id);
                        $stmt->execute();

                        $this->funcionarioService->changeIsWorking();
                        return 'O funcionario saiu da empresa!';
                    } catch (\Throwable $th) {
                        return $th;
                    }
                }else {
                    return 'O funcionário não esta na empresa!';
                }
            } catch (\Throwable $th) {
                return "Aconteceu um erro ao recuperar o funcionário";
            }
        } else{
            return 'O funcionário não esta na empresa!';
        }
    }
}