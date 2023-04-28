<?php
    require "./conectar.php";
    $link = conectar();
    $result = mysqli_query($link, "SELECT * FROM imagenes");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <div>
        <h1>Image upload</h1>
        <button></button>
        <!-- CONTINUAR CON LAS FOTOS. -->
    </div>
</body>
</html>