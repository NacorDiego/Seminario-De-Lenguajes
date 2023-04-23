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
        require "./scripts-PHP/helpers/traerData.php";
        $data = traerData($link);
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
                    <select name="" id="genero">
                        <option value="genero">Genero</option>
                    </select>
                </div>
                <div class="campo">
                    <label class="campo-label" for="plataforma">Plataforma</label>
                    <select name="" id="plataforma">
                        <option value="plataforma">Plataforma</option>
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
                <?php
                    require "./scripts-PHP/renderizarCards.php";
                    renderizarJuegos($data);
                ?>
            </ul>
        </div>
    </main>
    <footer class="footer">
        <span>Diego Ezequiel Nacor - Emanuel Gomez - 2023</span>
    </footer>
    <script src="./scripts/filtros.js" type="text/javascript"></script>
</body>
</html>