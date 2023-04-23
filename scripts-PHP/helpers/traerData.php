<?php

    function traerData($link){
        $query = "SELECT * FROM `juegos`";
        $result = mysqli_query($link,$query);

        if (!$result) {
            die("Error al ejecutar la consulta " . mysqli_error($link));
        }

        return $result;
    }

?>