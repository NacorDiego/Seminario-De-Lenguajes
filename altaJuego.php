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
        require './scripts-PHP/helpers/conexionBD.php';
        $link = conectar();
        require './scripts-PHP/helpers/traerDataCards.php';
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
            <div class="contenedor70">
                <form id="form-principal" action="./scripts-PHP/helpers/insertarData.php" method="POST" onsubmit="return validacion()" class="form-agregar-juego">
                    <div class="campo-juego">
                        <label class="campo-juego-label" for="nombre">Nombre</label>
                        <input class="campo-juego-input" id="nombre" name="nombre" type="text" placeholder="Ingrese el nombre del juego...">
                        <?php
                          session_start();
                        if(isset($_SESSION["errorNombre"])){
                        ?>
                            <div class="contenedor-error">
                                <span class="span-error" id="error-nombre"><?php echo $_SESSION["errorNombre"]; ?></span>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="contenedor-error">
                            <span class="span-error" id="error-nombre"></span>
                        </div>
                    </div>
                    <div class="campo-juego-img">
                        <div class="campo-juego-label">Imagen</div>
                        <label class="campo-juego-label" for="img-juego"></label>
                        <input class="campo-juego-input-img" id="img-juego" name="img-juego" type="file">
                        <?php
                        if(isset($_SESSION["errorImg"])){
                        ?>
                            <div class="contenedor-error">
                                <span class="span-error" id="error-img"><?php echo $_SESSION["errorImg"]; ?></span>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="contenedor-error">
                            <span class="span-error" id="error-img"></span>
                            <span class="span-info" id="info-img"></span>
                        </div>
                    </div>
                    <div class="campo-juego">
                        <label class="campo-juego-label" for="descripcion">Descripción</label>
                        <input class="campo-juego-input" id="descripcion" name="descripcion" type="text">
                        <?php
                        if(isset($_SESSION["errorDescrip"])){
                        ?>
                            <div class="contenedor-error">
                                <span class="span-error" id="error-descrip"><?php echo $_SESSION["errorDescrip"]; ?></span>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="contenedor-error">
                            <span class="span-error" id="error-descrip"></span>
                        </div>
                    </div>
                    <div class="campo-juego">
                        <label class="campo-juego-label" for="plataforma">Plataforma</label>
                        <select class="campo-juego-input" name="plataforma" id="plataforma">
                            <option value="0" selected>Seleccionar...</option>
                            <?php while($row = $plataformas -> fetch_assoc()){?>
                                <option value="<?php echo $row["id"] ?>"><?php echo $row["nombre"] ?></option>
                            <?php } ?>
                        </select>
                        <?php
                        if(isset($_SESSION["errorPlataforma"])){
                        ?>
                            <div class="contenedor-error">
                                <span class="span-error" id="error-plataforma"><?php echo $_SESSION["errorPlataforma"]; ?></span>
                            </div>
                        <?php
                        }
                        ?>
                     <div class="contenedor-error">
                            <span class="span-error" id="error-plataforma"></span>
                        </div>
                    </div>
                    <div class="campo-juego">
                        <label class="campo-juego-label" for="url">Url</label>
                        <input class="campo-juego-input" id="url" name="url" type="text">
                        <?php
                        if(isset($_SESSION["errorUrl"])){
                        ?>
                            <div class="contenedor-error">
                                <span class="span-error" id="error-url"><?php echo $_SESSION["errorUrl"]; ?></span>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="contenedor-error">
                            <span class="span-error" id="error-url"></span>
                        </div>
                    </div>
                    <div class="campo-juego">
                        <label class="campo-juego-label" for="genero">Genero</label>
                        <select class="campo-juego-input" name="genero" id="genero">
                            <option value="0" selected>Seleccionar...</option>
                            <?php while($row = $generos -> fetch_assoc()){?>
                                <option value="<?php echo $row["id"] ?>"><?php echo $row["nombre"] ?></option>
                            <?php } ?>
                        </select>

                        <?php
                        if(isset($_SESSION["errorGenero"])){
                        ?>
                            <div class="contenedor-error">
                                <span class="span-error" id="error-genero"><?php echo $_SESSION["errorGenero"]; ?></span>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="contenedor-error">
                            <span class="span-error" id="error-genero"></span>
                        </div>
                    </div>
                    <input type="submit" value="Agregar juego" class="boton-juego"></input>
                </form>
            </div>
        </div>
    </main>
    <footer class="footer">
        <span>Diego Ezequiel Nacor - Emanuel Gomez - 2023</span>
    </footer>
    <script src="./scripts/validaciones.js" type="text/javascript"></script>
</body>
</html>