<?php

    function traerDataCards($link){
        $query = "SELECT j.nombre as nombrejuego, j.imagen, j.descripcion, j.url, g.nombre as nombregenero, p.nombre as nombrePlataforma FROM juegos j INNER JOIN generos g ON j.id_genero = g.id INNER JOIN plataformas p ON j.id_plataforma = p.id;";
        $result = mysqli_query($link,$query);


        if (!$result) {
            die("Error al ejecutar la consulta " . mysqli_error($link));
        }

        return ($result);
    }

?>