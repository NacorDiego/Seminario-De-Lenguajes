<?php
    function conectar() {
        // Información de la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "imagenes";

        // Conexión a la base de datos
        $link = mysqli_connect($servername, $username, $password, $dbname);

        if (!$link) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        return $link;
    }
?>