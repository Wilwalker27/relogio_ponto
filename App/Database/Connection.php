<?php
class Connection
{
    private $DSN = 'mysql:host=localhost;dbname=time_clock'; // nome da database do mysql 'time_clock'
    private string $user = 'root'; // nome de usário para acesso ao banco de dados
    private string $password = 'root'; // senha de usário para acesso ao banco de dados

    public function connect(){
        try {
            $connection = new PDO($this->DSN, $this->user, $this->password);
            return $connection;
        } catch (\Throwable $th) {
            throw $th; // Lançar a exceção novamente
        }
    }
}
