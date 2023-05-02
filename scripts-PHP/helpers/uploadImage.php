<?php

    require "conexionBD.php";

    try {
        $link = conectar();

        $imgToInsert = addslashes(file_get_contents($_FILES["image"]['tmp_name']));

        $type = $_FILES['image']['type'];

        $sql = "INSERT INTO images(imagen,tipo_imagen) VALUES ('$imgToInsert', '$type')";

        mysqli_query($link,$sql);
        var_dump(mysqli_error($link));

        header("Location: index.php?msg=La imagen se inserto de forma correcta!&&error=false");
    } catch (Exception $e){
        header("Location: index.php?msg=".$e.getMessage()."!&&error=true");
    }

?>