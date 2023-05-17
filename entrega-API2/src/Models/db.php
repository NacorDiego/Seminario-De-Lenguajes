<?php

class Db
    {
        // Información de la base de datos
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "juegos";

        // Conexión a la base de datos
        public function connect()
        {
            try {
                $conexion = new PDO("mysql:host=". $this->servername .";dbname=". $this->dbname, $this->username, $this->password);
                // Establecer el modo de error PDO a excepción
                //Basicamente si rompe algo lo toma como una excepcion y se puede usar el try/catch
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Lo dejo para testear y ver maniana en la clase pero tenemos que retornar conexion
                // // Verificar la conexión
                // if ($conexion) {
                //     $message = "¡Conexión exitosa a la base de datos!";
                // }

                // return ($message ?? "Error en la conexión");

                return $conexion;
            } catch (PDOException $e) {
                die("Fallo la conexion: " . $e->getMessage());
            }
        }
    }
?>
