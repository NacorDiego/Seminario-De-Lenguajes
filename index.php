<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FUENTES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- MIS ESTILOS -->
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="./imgs/logo.svg"/>
    <title>Pagina de videojuegos</title>
</head>
<body>
    <?php
        require "./scripts-PHP/helpers/conexionBD.php";
        $link = conectar();
        require "./scripts-PHP/helpers/traerDataCards.php";
        $data = traerDataCards($link);
        require "./scripts-PHP/helpers/traerFiltrosGeneros.php";
        $generos = traerFiltrosGeneros($link);
        require "./scripts-PHP/helpers/traerFiltrosPlataformas.php";
        $plataformas = traerFiltrosPlataformas($link);
    ?>
    <header class="header">
        <nav class="nav">
            <img class="imagen-logo" src="./imgs/logo.svg" alt="logo">
        </nav>
    </header>
    <main class="contenedor">
        <!-- FORMULARIO -->
        <div class="contenedor100">
            <form class="formulario">
                <div class="campo">
                    <label class="campo-label" for="nombre">Nombre</label>
                    <input id="nombre" type="text"></input>
                </div>
                <div class="campo">
                    <label class="campo-label" for="genero">Genero</label>
                    <select name="genero" id="genero">
                        <option value="0" selected>Seleccionar...</option>
                        <?php while($row = $generos -> fetch_assoc()){?>
                            <option value="<?php echo $row["id"] ?>"><?php echo $row["nombre"] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="campo">
                    <label class="campo-label" for="plataforma">Plataforma</label>
                    <select name="" id="plataforma">
                        <option value="0" selected>Seleccionar...</option>
                        <?php while($row = $plataformas -> fetch_assoc()){?>
                            <option value="<?php echo $row["id"] ?>"><?php echo $row["nombre"] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="campo">
                    <label class="campo-label" for="ordenar">Ordenar por nombre</label>
                    <select name="" id="ordenar">
                        <option value="Ordenar">Letra</option>
                    </select>
                </div>
                <button class="boton-filtros"  onclick="filtros(event)" value="Filtrar juego">Filtrar</button>
            </form>
        </div>
        <!-- LISTA DE CARDS -->
        <div id="videojuegos-contenedor" class="videojuegos-contenedor">
            <ul class="videojuegos-lista">
                <?php while($row = $data -> fetch_assoc()){?>
                    <li class='juego'>
                        <div class='card'>
                            <a href='<?php echo $row["url"]; ?>' target="_blank"><img class='imagen-juego' src='<?php echo $row["imagen"]; ?>' alt='cat'></a>
                            <div class='card-contenido'>
                                <h4 class='titulo-juego'><?php echo $row["nombrejuego"]; ?></h4>
                                <ul class='lista-encabezados'>
                                    <li class='encabezado-juego'><b>Género:</b> <?php echo $row["nombregenero"]; ?></li>
                                    <li class='encabezado-juego'><b>Plataforma:</b> <?php echo $row["nombrePlataforma"]; ?></li>
                                    <li class='encabezado-juego'><b>Descripción:</b> <?php echo $row["descripcion"]; ?></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </main>
    <footer class="footer">
        <span>Diego Ezequiel Nacor - Emanuel Gomez - 2023</span>
    </footer>
    <!-- <script src="./scripts/index.js"></script> -->
    <script src="./scripts/filtros.js" type="text/javascript"></script>
</body>
</html>