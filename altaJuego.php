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
    <header class="header">
        <nav class="nav">
            <img class="imagen-logo" src="./imgs/logo.svg" alt="logo">
        </nav>
    </header>
    <main class="contenedor">
        <!-- FORMULARIO -->
        <div class="contenedor100">
            <div class="contenedor70">
                <form id="form-principal" class="form-agregar-juego">
                    <div class="campo-juego">
                        <label class="campo-juego-label" for="nombre">Nombre</label>
                        <input class="campo-juego-input" id="nombre" type="text" placeholder="Ingrese el nombre del juego...">
                        <div class="contenedor-error">
                            <span class="span-error" id="error-nombre"></span>
                        </div>
                    </div>
                    <div class="campo-juego-img">
                        <div class="campo-juego-label">Imagen</div>
                        <label class="campo-juego-label" for="img-juego"></label>
                        <input class="campo-juego-input-img" id="img-juego" type="file">
                        <div class="contenedor-error">
                            <span class="span-error" id="error-img"></span>
                            <span class="span-info" id="info-img"></span>
                        </div>
                    </div>
                    <div class="campo-juego">
                        <label class="campo-juego-label" for="descripcion">Descripción</label>
                        <input class="campo-juego-input" id="descripcion" type="text">
                        <div class="contenedor-error">
                            <span class="span-error" id="error-descrip"></span>
                        </div>
                    </div>
                    <div class="campo-juego">
                        <label class="campo-juego-label" for="plataforma">Plataforma</label>
                        <select class="campo-juego-input" name="" id="plataforma">
                            <option value="0" selected>Seleccionar...</option>
                            <option value="1">Opción 1</option>
                            <option value="2">Opción 2</option>
                        </select>
                        <div class="contenedor-error">
                            <span class="span-error" id="error-plataforma"></span>
                        </div>
                    </div>
                    <div class="campo-juego">
                        <label class="campo-juego-label" for="url">Url</label>
                        <input class="campo-juego-input" id="url" type="text">
                        <div class="contenedor-error">
                            <span class="span-error" id="error-url"></span>
                        </div>
                    </div>
                    <div class="campo-juego">
                        <label class="campo-juego-label" for="genero">Genero</label>
                        <select class="campo-juego-input" name="" id="genero">
                            <option value="Ordenar" selected>Seleccionar...</option>
                            <option value="Ordenar">Opción 1</option>
                            <option value="Ordenar">Opción 2</option>
                        </select>
                    </div>
                    <input type="button" value="Agregar juego" class="boton-juego" onclick="validacion()">
                </form>
            </div>
        </div>
    </main>
    <footer class="footer">
        <span>Diego Ezequiel Nacor - Emanuel Gomez - 2023</span>
    </footer>
    <script src="./scripts/validaciones.js" type="text/javascript"></script>
    <?php
        // Información de la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "juegos";

        // Conexión a la base de datos
        $link = mysqli_connect($servername, $username, $password, $dbname);

        // Verificar si la conexión es exitosa
        if (!$link) {
            die("Conexión fallida: " . mysqli_connect_error());
        }
        // echo "Conexión exitosa";

        // Consulta SQL
        $sql = "SELECT * FROM generos";

        // Enviar consulta a la base de datos
        $resultado = mysqli_query($link, $sql);

        // Verificar si la consulta es exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($link));
        }else{
            echo "Se conecto correctamente " .  mysqli_num_rows($resultado);
        }
    ?>
</body>
</html>