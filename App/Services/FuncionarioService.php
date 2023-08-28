<?php

class FuncionarioService
{
    private $funcionario;
    private $connection;

    public function __construct(Connection $conn, FuncionarioModel $funcionario = null)
    {
        $this->connection = $conn->connect();
        $this->funcionario = $funcionario;
    }
    public function createFuncionario()
    {
        if (!empty($this->funcionario->__get('name'))) {
            try {
                $query = '
                INSERT INTO
                    funcionarios(name)
                VALUES
                    (:name)
            ';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':name', $this->funcionario->__get('name'));
            $stmt->execute();
            header('Location:horarioTrabalhado.php');
            } catch (\Throwable $th) {
                return "Aconteceu algum erro!";
            }
        } else {
            return 'Nome invalido';
        }
        
    }
    public function getAllFuncionario()
    {
        try {
            $query = '
                SELECT
                    *
                FROM 
                    funcionarios
            ';
            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            $funcionario = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $funcionario;
        } catch (\Throwable $th) {
            return [];
        }
    }
    public function getFuncionario()
    {
        try {
            $query = '
                SELECT
                    *
                FROM 
                    funcionarios
                WHERE
                    id = :id
            ';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('id', $this->funcionario->id);
            $stmt->execute();

            $funcionario = $stmt->fetch(PDO::FETCH_OBJ);

            return $funcionario;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function changeIsWorking()
    {
        $this->funcionario = $this->getFuncionario();
        if ($this->funcionario->is_working == 0) {
            try {
                $query = '
                    UPDATE 
                        funcionarios
                    SET 
                        is_working = :is_working
                    WHERE 
                        id = :id 
                ';
                $stmt = $this->connection->prepare($query);
                $stmt->bindValue(':id', $this->funcionario->id);
                $stmt->bindValue(':is_working', 1);
                $stmt->execute();
    
                return true;
            } catch (\Throwable $th) {
                return $th;
            }
        }
        if ($this->funcionario->is_working == 1) {
            try {
                $query = '
                    UPDATE 
                        funcionarios
                    SET 
                        is_working = :is_working
                    WHERE 
                        id = :id 
                ';
                $stmt = $this->connection->prepare($query);
                $stmt->bindValue(':id', $this->funcionario->id);
                $stmt->bindValue(':is_working', 0);
                $stmt->execute();
    
                return true;
            } catch (\Throwable $th) {
                return $th;
            }
        }
    }

    public function getWorkTime($horarios)
{
    $somatoriaHoras = 0;
    $somatoriaMinutos = 0;

    foreach ($horarios as $key => $horario) {
        $datatime1 = new DateTime($horario->horario_entrada);
        $datatime2 = new DateTime($horario->horario_saida);

        $diff = $datatime1->diff($datatime2);
        $horas = $diff->h + ($diff->days * 24);
        $minutos = $diff->i + ($diff->days * 1440);

        $somatoriaHoras += $horas;
        $somatoriaMinutos += $minutos;
    }

    // Convertendo minutos extras em horas
    $somatoriaHoras += floor($somatoriaMinutos / 60);
    $somatoriaMinutos = $somatoriaMinutos % 60;

    return ["entrada" => $horario->horario_entrada, "minutos" => $horario->horario_saida];
}

}