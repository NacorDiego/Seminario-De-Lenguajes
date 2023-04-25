<?php
    function insertarData($link){
        $nombre = $_POST['nombre'];
        $img = $_POST['img-juego'];
        $descrip = $_POST['descripcion'];
        $url = $_POST['url'];
        $plataforma = $_POST['plataforma'];
        // $genero = $_POST['genero'];


        echo 'holo';
        $query = "INSERT INTO `juegos`(`nombre`, `imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) VALUES ('$nombre', '$img','$descrip','$url', '1','$plataforma')";

        $result = mysqli_query($link, $query);


    }

    require ("./conexionBD.php");
    $link = conectar();
    insertarData($link);
?>