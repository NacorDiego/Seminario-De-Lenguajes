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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- FUENTE - ROBOTO -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- FUENTE - MONTSERRAT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- MIS ESTILOS -->
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="./imgs/logo.svg"/>
    <title>Pagina de videojuegos</title>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <div style="width:30%">
            </div>
            <div style="width:40%; display:flex; justify-content:center;">
                <a href="#">
                    <img class="imagen-logo" src="./imgs/logo.svg" alt="logo">
                </a>
            </div>
            <div style="width: 30%;">
                <a href="altajuego.php" class="btn-agregar"><i class="fa-solid fa-plus"></i> Agregar juego</a>
            </div>
        </nav>
    </header>
    <main class="contenedor">
        <!-- FORMULARIO -->
        <div class="contenedor100">
            <form class="formulario" action="index.php" method="GET">
                <div class="campo">
                    <label class="campo-label" for="nombre">Nombre</label>
                    <input class="campo-input" name="nombre" id="nombre" type="text" value="<?php echo isset($_GET["nombre"])?$_GET["nombre"]:"" ?>"></input>
                </div>
                <div class="campo">
                    <label class="campo-label" for="genero">Genero</label>
                    <select class="campo-input" name="genero" id="genero">
                        <option value="">Seleccionar...</option>
                        <?php while($row = $generos -> fetch_assoc()){?>
                            <option value="<?php echo $row["id"] ?>" <?php echo isset($_GET["genero"]) && $_GET["genero"]==$row["id"]?"selected":"" ?> ><?php echo $row["nombre"] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="campo">
                    <label class="campo-label" for="plataforma">Plataforma</label>
                    <select class="campo-input" name="plataforma" id="plataforma">
                        <option value="" selected>Seleccionar...</option>
                        <?php while($row = $plataformas -> fetch_assoc()){?>
                            <option value="<?php echo $row["id"] ?>" <?php echo isset($_GET["plataforma"]) && $_GET["plataforma"]==$row["id"]?"selected":"" ?> ><?php echo $row["nombre"] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="campo">
                    <label class="campo-label" for="ordenar">Ordenar por nombre</label>
                    <select class="campo-input" name="ordenar" id="ordenar">
                        <option value="">Seleccionar...</option>
                        <option value="ASC" <?php echo isset($_GET["ordenar"]) && $_GET["ordenar"]=="ASC"?"selected":""; ?> >Ascendente</option>
                        <option value="DESC" <?php echo isset($_GET["ordenar"]) && $_GET["ordenar"]=="DESC"?"selected":""; ?> >Descendente</option>
                    </select>
                </div>
                <input type="submit" class="boton-filtros"  value="Filtrar">
            </form>
        </div>
        <!-- LISTA DE CARDS -->
        <div id="videojuegos-contenedor" class="videojuegos-contenedor">
            <ul class="videojuegos-lista">
                <?php while($row = $data -> fetch_assoc()){?>
                    <li class='juego'>
                        <a href='<?php echo $row["url"]; ?>' target="_blank">
                            <div class='card'>
                                <!--  -->
                                <img class='imagen-juego' src="data:<?php echo $row["tipo_imagen"]; ?>;base64,<?php echo $row["imagen"]; ?>" alt='cat'>
                                <div class='card-contenido'>
                                    <h4 class='titulo-juego'><?php echo $row["nombrejuego"]; ?></h4>
                                    <ul class='lista-encabezados'>
                                        <li class='encabezado-juego'><b>Género:</b> <?php echo $row["nombregenero"]; ?></li>
                                        <li class='encabezado-juego'><b>Plataforma:</b> <?php echo $row["nombrePlataforma"]; ?></li>
                                        <li class='encabezado-juego'><b>Descripción:</b> <?php echo $row["descripcion"]; ?></li>
                                    </ul>
                                </div>
                            </div>
                        </a>
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