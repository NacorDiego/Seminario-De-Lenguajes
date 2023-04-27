<?php
    function insertarData($link){
        session_start();

        $nombre = $_POST['nombre'];
        $img = $_POST['img-juego']; // La imagen no viene por POST sino por $_FILE.
        // CREATE TABLE IF NOT EXISTS `images` (
        //     `id` int(11) NOT NULL AUTO_INCREMENT,
        //     `imagen` text NOT NULL,
        //     `tipo_imagen` varchar(255) NOT NULL,
        //     UNIQUE KEY `id` (`id`)
        // ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
        $descrip = $_POST['descripcion'];
        $url = $_POST['url'];
        $plataforma = $_POST['plataforma'];
        $genero = $_POST['genero'];

        // Validaciones
        if($nombre === ""){
            $_SESSION["errorNombre"] = "El campo nombre es requerido.";
        }

        $query = "INSERT INTO `juegos`(`nombre`, `imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) VALUES ('$nombre', '$img','$descrip','$url', '$genero','$plataforma')";

        $result = mysqli_query($link, $query);



        header('Location: ../../altaJuego.php');

    }

    require ("./conexionBD.php");
    $link = conectar();
    insertarData($link);
?>