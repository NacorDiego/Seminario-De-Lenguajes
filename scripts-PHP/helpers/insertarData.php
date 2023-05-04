<?php
    function insertarData($link){
        session_start();

        $nombre = $_POST['nombre'];
        //[error] numero que te indica el codigo de error del archivo. 0: No tiene ningun error. Hay uno que el usuario no selecciono archivo, otro que el archivo tuvo un error, otro que supero el tamaño de archivo.
        if(!$_FILES['img-juego']['error']){
            $img = base64_encode(file_get_contents($_FILES['img-juego']['tmp_name'])); //addslashes pone barras invertidas y limpia el string. file_get_contents a partir de un path recupera el archivo real o binario que necesitamos.
        }else{
            $_SESSION["errorImg"] = "El campo imagen es requerido.";
        }
        $type = $_FILES['img-juego']['type']; // [size] trae el tamaño de la imagen.
        $descrip = $_POST['descripcion'];
        $url = $_POST['url'];
        $plataforma = $_POST['plataforma'];
        $genero = $_POST['genero'];

        // Validaciones
        if($nombre === ""){
            $_SESSION["errorNombre"] = "El campo nombre es requerido.";
        }

        if($type !== "image/jpg" && $type !== "image/png" && $type !== "image/jpeg"){
            $_SESSION["errorImg"] = "El type no es compatible.";
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