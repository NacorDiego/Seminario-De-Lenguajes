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
        require "./scripts-PHP/conexionBD.php";
        $link = conectar();
        require "./scripts-PHP/traerData.php";
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
                <button class="boton-filtros" type="submit">Filtrar</button>
            </form>
        </div>
        <!-- LISTA DE CARDS -->
        <div id="videojuegos-contenedor" class="videojuegos-contenedor">
            <ul class="videojuegos-lista">
                <?php
                    require "./scripts-PHP/renderizarJuegos.php";
                    renderizarJuegos($data);
                ?>
                <!-- <li class="juego">
                    <div class="card">
                        <img class="imagen-juego" src="./imgs/imagen-card.jpg" alt="cat">
                        <div class="card-contenido">
                            <h4 class="titulo-juego">Titulo del juego</h4>
                            <ul class="lista-encabezados">
                                <li class="encabezado-juego"><b>Género:</b></li>
                                <li class="encabezado-juego"><b>Plataforma:</b></li>
                                <li class="encabezado-juego"><b>Descripcion:</b></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="juego">
                    <div class="card">
                        <img class="imagen-juego" src="./imgs/imagen-card.jpg" alt="cat">
                        <div class="card-contenido">
                            <h4 class="titulo-juego">Titulo del juego</h4>
                            <ul class="lista-encabezados">
                                <li class="encabezado-juego"><b>Género:</b></li>
                                <li class="encabezado-juego"><b>Plataforma:</b></li>
                                <li class="encabezado-juego"><b>Descripcion:</b></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="juego">
                    <div class="card">
                        <img class="imagen-juego" src="./imgs/imagen-card.jpg" alt="cat">
                        <div class="card-contenido">
                            <h4 class="titulo-juego">Titulo del juego</h4>
                            <ul class="lista-encabezados">
                                <li class="encabezado-juego"><b>Género:</b></li>
                                <li class="encabezado-juego"><b>Plataforma:</b></li>
                                <li class="encabezado-juego"><b>Descripcion:</b></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="juego">
                    <div class="card">
                        <img class="imagen-juego" src="./imgs/imagen-card.jpg" alt="cat">
                        <div class="card-contenido">
                            <h4 class="titulo-juego">Titulo del juego</h4>
                            <ul class="lista-encabezados">
                                <li class="encabezado-juego"><b>Género:</b></li>
                                <li class="encabezado-juego"><b>Plataforma:</b></li>
                                <li class="encabezado-juego"><b>Descripcion:</b></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="juego">
                    <div class="card">
                        <img class="imagen-juego" src="./imgs/imagen-card.jpg" alt="cat">
                        <div class="card-contenido">
                            <h4 class="titulo-juego">Titulo del juego</h4>
                            <ul class="lista-encabezados">
                                <li class="encabezado-juego"><b>Género:</b></li>
                                <li class="encabezado-juego"><b>Plataforma:</b></li>
                                <li class="encabezado-juego"><b>Descripcion:</b></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="juego">
                    <div class="card">
                        <img class="imagen-juego" src="./imgs/imagen-card.jpg" alt="cat">
                        <div class="card-contenido">
                            <h4 class="titulo-juego">Titulo del juego</h4>
                            <ul class="lista-encabezados">
                                <li class="encabezado-juego"><b>Género:</b></li>
                                <li class="encabezado-juego"><b>Plataforma:</b></li>
                                <li class="encabezado-juego"><b>Descripcion:</b></li>
                            </ul>
                        </div>
                    </div>
                </li> -->
            </ul>
        </div>
    </main>
    <footer class="footer">
        <span>Diego Ezequiel Nacor - Emanuel Gomez - 2023</span>
    </footer>
</body>
</html>