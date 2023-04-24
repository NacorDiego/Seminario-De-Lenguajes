<?php

    // function renderizarJuegos($data){
    //     while ($row = mysqli_fetch_array ($data)) {
    //         $titulo = $row['nombre'];
    //         $descripcion = $row['descripcion'];
    //         $url = $row['url'];
    //         $idGenero = $row['id_genero'];
    //         // $generoQuery = "SELECT * FROM `generos` WHERE id=$idGenero";
    //         // $generos = mysqli_query($link,$generoQuery);
    //         // $genero = mysqli_fetch_array ($generos);
    //         // echo $genero;
    //         $plataforma = $row['id_plataforma'];
    //         $imagen = $row['imagen'];
    //         echo ("<li class='juego'>
    //             <div class='card'>
    //                 <a href='$url'><img class='imagen-juego' src='$imagen' alt='cat'></a>
    //                 <div class='card-contenido'>
    //                     <h4 class='titulo-juego'>$titulo</h4>
    //                     <ul class='lista-encabezados'>
    //                         <li class='encabezado-juego'><b>Género:$idGenero</b></li>
    //                         <li class='encabezado-juego'><b>Plataforma:$plataforma</b></li>
    //                         <li class='encabezado-juego'><b>Descripcion:$descripcion</b></li>
    //                     </ul>
    //                 </div>
    //             </div>
    //         </li>");
    //     }
    // }

    // require("./helpers/conexionBD");
    // require("./helpers/traerData");
    // $link = conectar();
    // $resultado = traerData($link);

    function renderizarJuegos($data){

        // $data = json_decode(file_get_contents('php://input'), true);
        // $data = $resultado;
        header('Content-Type: application/json');
        echo json_encode($data);

    }





?>
