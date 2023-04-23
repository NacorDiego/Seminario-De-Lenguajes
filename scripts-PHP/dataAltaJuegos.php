<?php
    function insertarData($link){
        $nombre = $_POST['nombre'];
        $img = $_POST['img-juego'];
        $plataforma = $_POST['descripcion'];
        $descrip = $_POST['plataforma'];
        $url = $_POST['url'];
        $genero = $_POST['genero'];

        // $sql = INSERT INTO `juegosdb`(`nombre`, `imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) VALUES ($nombre,$img,$descrip,$url,$genero,$plataforma);
        header("Location: ../altaJuego.php");

    }
?>