<?php

    function traerData($link){
        $query = "SELECT j.nombre as nombrejuego, g.nombre as nombregenero FROM juegos j INNER JOIN generos g ON j.id_genero = g.id;";
        $result = mysqli_query($link,$query);


        if (!$result) {
            die("Error al ejecutar la consulta " . mysqli_error($link));
        }

        return ($result);
    }

?>