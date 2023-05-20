<?php

class Db
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "juegos";
    private $connection;

    public function connect()
    {
        try {
            $this->connection = new PDO("mysql:host=". $this->servername .";dbname=". $this->dbname, $this->username, $this->password);
            // Establecer el modo de error PDO a excepción
            // si rompe algo lo toma como una excepcion y se puede usar el try/catch ()
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Fallo la conexion: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
?>
