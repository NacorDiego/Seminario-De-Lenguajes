<?php

    function traerData($link){
        $query = "SELECT * FROM `juegos`";
        $result = mysqli_query($link,$query);

        return $result;
    }

?>