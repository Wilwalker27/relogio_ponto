<?php
class PontoService
{
    private $connection;
    private $funcionario;

    public function __construct(Connection $conn, FuncionarioModel $funcionario)
    {
        $this->connection = $conn->connect();
        $this->funcionario = $funcionario;
    }

    public function entrada()
    {
        try {
            $query = '
                INSERT INTO 
                    pontos(id_funcionario)
                VALUES(:id_funcionario)
            ';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':id_funcionario', $this->funcionario->__get('id'));
            $stmt->execute();
        
        return true;
        } catch (\Throwable $th) {
            return false;
        }

    }
}