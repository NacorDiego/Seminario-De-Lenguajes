<?php

    function traerFiltrosPlataformas($link){

        $query = "SELECT * FROM plataformas";

        $result = mysqli_query($link,$query);

        if(!$result){
            die("La consulta por las plataformas falló: ".mysqli_error($link));
        }

        return $result;

    }

?>