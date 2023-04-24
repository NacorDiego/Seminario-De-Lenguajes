<?php

    function traerData($link){
        $query = "SELECT * FROM `juegos`";
        $result = mysqli_query($link,$query);

        $datos = array();
        
        while ($fila = $result -> fetch_assoc()) {
            $datos[] = $fila;
        }

        if (!$result) {
            die("Error al ejecutar la consulta " . mysqli_error($link));
        }

        return json_encode($datos);
    }

?>