<?php

    function traerDataCards($link){

        $query = "SELECT j.nombre as nombrejuego, j.imagen, j.tipo_imagen, j.descripcion, j.url, g.nombre as nombregenero, p.nombre as nombrePlataforma FROM juegos j INNER JOIN generos g ON j.id_genero = g.id INNER JOIN plataformas p ON j.id_plataforma = p.id WHERE 1 = 1";
        if(!empty($_GET)){
            $genero = $_GET["genero"];
            $plataforma = $_GET["plataforma"];
            $nombre = $_GET["nombre"];
            $orden = $_GET["ordenar"];
            if($genero != ""){
                $query = $query." AND g.id = $genero";
            }
            if($plataforma != ""){
                $query = $query." AND p.id = $plataforma";
            }
            if($nombre != ""){
                $query = $query." AND j.nombre LIKE '$nombre%'"; // Devuelve todos los matcheos.
            }
            if($orden != ""){
                $query = $query." ORDER BY j.nombre $orden";
            }
        }

        $result = mysqli_query($link,$query);


        if (!$result) {
            die("Error al ejecutar la consulta " . mysqli_error($link));
        }

        return ($result);
    }

?>