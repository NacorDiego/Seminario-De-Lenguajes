<?php
    function insertarData($link){
        session_start();

        $nombre = $_POST['nombre'];
        $img = addslashes(file_get_contents($_FILES["image"]['tmp_name']));
        $type = $_FILES['image']['type'];
        $descrip = $_POST['descripcion'];
        $url = $_POST['url'];
        $plataforma = $_POST['plataforma'];
        $genero = $_POST['genero'];

        // Validaciones
        if($nombre === ""){
            $_SESSION["errorNombre"] = "El campo nombre es requerido.";
        }

        if($img === ""){
            $_SESSION["errorImg"] = "El campo imagen es requerido.";
        }

        if(strlen($descrip) > 255){
            $_SESSION["errorDescrip"] = "El campo descripcion excede el largo disponible.";
        }

        if(strlen($url) > 80){
            $_SESSION["errorUrl"] = "El campo Url excede el largo disponible.";
        }

        if($plataforma == 0){
            $_SESSION["errorPlataforma"] = "Debes seleccionar una plataforma.";
        }

        if($genero == 0){
            $_SESSION["errorGenero"] = "Debes seleccionar un genero.";
        }

        if(
            isset($_SESSION["errorNombre"]) ||
            isset($_SESSION["errorImg"]) ||
            isset($_SESSION["errorDescrip"]) ||
            isset($_SESSION["errorUrl"]) ||
            isset($_SESSION["errorPlataforma"]) ||
            isset($_SESSION["errorGenero"])
        ){

            header('Location: ../../altaJuego.php');
            return;
        }

        $query = "INSERT INTO `juegos`(`nombre`, `imagen`, `tipo_imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) VALUES ('$nombre', '$img','$type','$descrip','$url', '$genero','$plataforma')";

        // $result = mysqli_query($link, $query);
        mysqli_query($link, $query);

        header('Location: ../../altaJuego.php');
    }

    require ("./conexionBD.php");
    $link = conectar();
    insertarData($link);
?>


<!-- // CREATE TABLE IF NOT EXISTS `images` (
        //     `id` int(11) NOT NULL AUTO_INCREMENT,
        //     `imagen` text NOT NULL,
        //     `tipo_imagen` varchar(255) NOT NULL,
        //     UNIQUE KEY `id` (`id`)
        // ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1; -->