<?php
class Connection
{
    private $DSN = 'mysql:host=localhost;dbname=project';
    private string $user = 'root';
    private string $password = 'root';

    public function connect(){
        try {
            $connection = new PDO($this->DSN, $this->user, $this->password);
            return $connection;
        } catch (\Throwable $th) {
            throw $th; // Lançar a exceção novamente
        }
    }
}
