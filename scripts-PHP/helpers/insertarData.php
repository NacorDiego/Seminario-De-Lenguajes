<?php
    function insertarData($link){
        $nombre = $_POST['nombre'];
        $img = $_POST['img-juego'];
        $descrip = $_POST['descripcion'];
        $url = $_POST['url'];
        $plataforma = $_POST['plataforma'];
        $genero = $_POST['genero'];

        $query = "INSERT INTO `juegos`(`nombre`, `imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) VALUES ('$nombre', '$img','$descrip','$url', '$genero','$plataforma')";

        $result = mysqli_query($link, $query);

        header('Location: ../../altaJuego.php');
        // if ($result) {

        //     echo '<script>alert("Agregado")</script>';
        // }

    }

    require ("./conexionBD.php");
    $link = conectar();
    insertarData($link);
?>