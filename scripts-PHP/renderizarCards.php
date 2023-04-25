<?php
    function renderizarJuegos($data){
        $datajson = json_decode($data,true);
        foreach($datajson as $clave => $juego){

            $url = $juego['url'];
            $img = $juego['imagen'];
            $nombre = $juego['nombre'];
            $descripcion = $juego['descripcion'];
            $id_genero = $juego['id_genero'];
            $id_plataforma = $juego['id_plataforma'];

            echo ("<li class='juego'>
                    <div class='card'>
                        <a href='$url'><img class='imagen-juego' src='$img' alt='cat'></a>
                        <div class='card-contenido'>
                            <h4 class='titulo-juego'>$nombre</h4>
                            <ul class='lista-encabezados'>
                                <li class='encabezado-juego'><b>Género:$id_genero</b></li>
                                <li class='encabezado-juego'><b>Plataforma:$id_plataforma</b></li>
                                <li class='encabezado-juego'><b>Descripcion:$descripcion</b></li>
                            </ul>
                        </div>
                    </div>
                </li>");
        }
    }

?>
