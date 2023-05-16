<?php

    function traerFiltrosGeneros($link){
        $query = "SELECT * FROM generos";

        $result = mysqli_query($link,$query);

        if(!$result) {
            die("Error al ejecutar la consulta de generos ".mysqli_error($link));
        }

        return ($result);
    }

?>