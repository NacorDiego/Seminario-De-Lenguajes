<?php
    function conectar() {
        // Información de la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "juegos";

        // Conexión a la base de datos
        $link = mysqli_connect($servername, $username, $password, $dbname);
        return $link;
    }
/*
        // Verificar si la conexión es exitosa
        if (!$link) {
            die("Conexión fallida: " . mysqli_connect_error());
        }
        // echo "Conexión exitosa";

        // Consulta SQL
        $sql = "SELECT * FROM generos";

        // Enviar consulta a la base de datos
        $resultado = mysqli_query($link, $sql);

        // Verificar si la consulta es exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($link));
        }else{
            echo "Se conecto correctamente " .  mysqli_num_rows($resultado);
        }
        */
    ?>