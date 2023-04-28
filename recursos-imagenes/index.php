<?php

	$msg = '';
	$errorType = false;
	if (isset($_GET['msg']) && isset($_GET['error'])) {
		$msg = $_GET['msg'];
		$errorType = $_GET['error'];
	}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Image Upload</title>
	<link rel="stylesheet" href="./assets/styles.css">
</head>

<body>

	<h1>Ver Imagenes de la base de datos</h1>

	<!--Paso 1 - Mostrar como se visualiza el blob en un tag img-->
	<button onclick="window.location.href='./showImgWithoutEncode.php'">Ver Imagenes sin encode</button>

	<!--Paso 2 - Mostrar como se visualiza el blob en un tag img con el encode de base64-->
	<button onclick="window.location.href='./showImg.php'">Ver Images</button>

	<hr />

	<h1>Img upload example</h1>

	<?php 
		if ($msg !== '') {
			?>
				<p class="<?php echo $errorType ? 'alert-ok': 'alert-ok'?>"> <?php echo $msg ?></p>
			<?php
		}
	?>

	<form action="upload.php" method="post" enctype="multipart/form-data"> 
    <!-- enctype permite poder enviar el archivo por el form. -->

		<label>Select Image File:</label>
		<input type="file" name="image">
		<input type="submit" name="submit" value="Upload">
	</form>

</body>

</html>