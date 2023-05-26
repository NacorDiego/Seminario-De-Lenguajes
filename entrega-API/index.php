<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;

    //Se encarga de cargar automaticamente todas las clases y dependencias definidas en tu proyecto PHP.
    require __DIR__ . '/vendor/autoload.php';
    require 'src/Models/db.php';

    $app = AppFactory::create();

    // Crear una instancia de la clase Db
    $db = new Db();

    // Llamar al método connect()
    $db -> connect();

    //Todas las funciones se repiten pero cambian pocas cosas, falta agregar errores 404 y 400. Por ahora esta todo sin catchear errores
    //Investigar como mover todos los endpoints de genero a otro archivo y modularizarlo.

    //? A) Crear un nuevo género

    $app -> post('/generos', function (Request $request, Response $response) use ($db) {
        //getBody obtiene todas las solicitudes enviadas al servidor (POST) //Modularizar
        $requestBody = $request -> getBody();
        //json_decode convierte el json en un array asociativo (basicamente que PHP pueda interpretar la data JSON)
        $data = json_decode($requestBody, true);
        //en $data estan todos las props que mandamos desde Postman
        $nombreGenero = $data['nombreGenero'];

        // Obtén la conexión a la base de datos
        $connection = $db -> getConnection();

        // Insertar el nuevo género en la base de datos
        $sqlInsert = $connection -> prepare("INSERT INTO `generos`(`nombre`) VALUES (?)");
        // Agregar try/catch si falla el execute con 404 creo
        //Donde va el signo de pregunta es donde se inserta la variable
        $sqlInsert -> execute([$nombreGenero]);

        // Devolver una respuesta exitosa // Modularizar
        $jsonData = json_encode(['message' => 'Genero creado exitosamente']);
        $responseBody = $response -> getBody();
        $responseBody -> write($jsonData);
        return $response -> withStatus(200) -> withBody($responseBody);
    });

    //? B) Actualizar información de un género

    $app -> put('/generos/{id}', function (Request $request, Response $response, $args) use ($db){
        // Obtiene la petición en formato json
        $requestBody = $request -> getBody();
        // Transforma el json a un array y lo guarda en $data
        $data = json_decode($requestBody, true);
        // Obtiene los datos que vienen en "nombreGenero" e "idGenero" y los guarda en las variables
        $nombreGenero = $data['nombreGenero'];
        $idGenero = $args['id'];

        // Obtiene la conexión a la bd mediante la instancia de Db.
        $connection = $db -> getConnection();

        // Guarda en $sqlUpdate la query preparada para actualizar el genero de nombre=? y id=?
        $sqlUpdate = $connection -> prepare("UPDATE `generos` SET `nombre` = ? WHERE `id` = ?");
        // Ejecuta la query con los datos pasados como param en la BD.
        $sqlUpdate -> execute([$nombreGenero, $idGenero]);

        // Guarda el msj en un array y lo encodea a json
        $jsonData = json_encode(['message' => 'Genero actualizado exitosamente']);
        // Almacena la referencia al cuerpo de la respuesta en $responseBody
        $responseBody = $response -> getBody();
        // Escribe en el cuerpo de la respuesta el json guardado con el msj anteriormente
        $responseBody -> write($jsonData);
        // Retorna una respuesta HTTP con codigo 200 (éxito) y el cuerpo con el json
        return $response -> withStatus(200) -> withBody($responseBody);
    });


    //? C) Eliminar un género

    $app->delete('/generos/{id}', function (Request $request, Response $response, $args) use ($db){
        $idGenero = $args['id'];

        $connection = $db -> getConnection();

        $sqlDelete = $connection -> prepare("DELETE FROM `generos` WHERE `id` = ?");
        $sqlDelete -> execute([$idGenero]);

        $jsonData = json_encode(['message' => 'Genero eliminado exitosamente']);
        $responseBody = $response -> getBody();
        $responseBody -> write($jsonData);
        return $response -> withStatus(200) -> withBody($responseBody);
    });

    //? D) Obtener todos los géneros

    $app -> get('/generos', function (Request $request, Response $response, $args) use ($db){
        // var_dump($request->getQueryParams());
        // die;
        // Conecto a la BD.
        $connection = $db -> getConnection();
        // Defino query
        $sqlSelect = $connection -> prepare("SELECT DISTINCT * FROM `generos`");

        if (!$sqlSelect){
            // Si hay un error en la preparación de la consulta:

            $errorData = ['error' => 'Error en la consulta'];
            $errorJson = json_encode($errorData);
            $responseBody = $response -> getBody();
            $responseBody -> write($errorJson);
            return $response -> withStatus(400) -> withBody($responseBody);
        }

        if ($sqlSelect -> execute()){
            // Si se ejecuta la consulta correctamente en la BD:

            // Ejecuto la query en la BD.
            $sqlSelect -> execute();
            // Obtengo los datos devueltos por la BD y los guardo en $result
            $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);
            // Encodeo los datos como json
            $jsonData = json_encode($result);
            // Obtengo una instancia del cuerpo de la respuesta
            $responseBody = $response -> getBody();
            // Guardo la data en el cuerpo de la respuesta
            $responseBody -> write($jsonData);
            // Retorno la respuesta
            return $response -> withStatus(200) -> withBody($responseBody);
        } else {
            // Si hay un error en la ejecución de la consulta:

            $errorData = ['error' => 'Error en la ejecución de la consulta a la BD.'];
            $errorJson = json_encode($errorData);
            $responseBody = $response -> getBody();
            $responseBody -> write($errorJson);
            return $response -> withStatus(400) -> withBody($responseBody);
        }

        // Si la tabla indicada no existe (no se ejecuta ninguno de los return anteriores):

        $errorData = ['error' => 'La tabla indicada no existe'];
        $errorJson = json_encode($errorData);
        $responseBody = $response -> getBody();
        $responseBody -> write($errorJson);
        return $response -> withStatus(404) -> withBody($responseBody);
    });

    //? E) Crear una nueva plataforma

    $app -> post('/plataformas', function (Request $request, Response $response, $args) use ($db){
        try{
            $requestBody = $request -> getBody();
            $data = json_decode($requestBody,true);

            if (!isset($data['nombrePlataforma'])){
                throw new Exception('El campo nombrePlataforma es requerido');
            }

            $nombrePlataforma = $data['nombrePlataforma'];

            $connection = $db -> getConnection();

            $sqlInsert = $connection -> prepare("INSERT INTO `plataformas`(`nombre`) VALUES(?)");
            $sqlInsert -> execute([$nombrePlataforma]);

            $jsonData = json_encode(['message' => 'Plataforma creada exitosamente']);
            $responseBody = $response -> getBody();
            $responseBody -> write($jsonData);

            return $response -> withStatus(200) -> withBody($responseBody);
        } catch (Exception $e) {
            $errorData = ['error' => $e -> getMessage()];
            $jsonError = json_encode($errorData);
            $response -> getBody() -> write($jsonError);

            return $response -> withStatus(400) -> withHeader('Content-Type', 'application/json');
        }
    });

    //? F) Actualizar información de una plataforma

    $app -> put('/plataformas/{id}', function (Request $request, Response $response, $args) use ($db){
        try {
            $requestBody = $request -> getBody();
            $data = json_decode($requestBody, true);
            $idPlataforma = $args['id'];

            // Si no existe o es null se genera una excepción.
            if (!isset($data['nombrePlataforma'])){
                throw new Exception ('El campo nombrePlataforma es requerido.');
            } elseif ($data['nombrePlataforma'] == ""){
                throw new Exception ('El campo nombrePlataforma no puede estar vacio.');
            }

            $nombrePlataforma = $data['nombrePlataforma'];
            $connection = $db -> getConnection();

            // Valido si el ID existe en la tabla plataformas, sino lanzo excepción.
            $sqlSelect = $connection -> prepare('SELECT COUNT(*) FROM `plataformas` WHERE id = ?');
            $sqlSelect -> execute([$idPlataforma]);
            $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);
            if(!($result[0]['COUNT(*)'] > 0)){
                throw new Exception ('No hay ningun registro con el ID especificado.');
            }

            $sqlUpdate = $connection -> prepare('UPDATE `plataformas` SET `nombre` = ? WHERE id = ?');
            $sqlUpdate -> execute([$nombrePlataforma,$idPlataforma]);

            $jsonData = json_encode('La plataforma se actualizo con exito.');
            $responseBody = $response -> getBody();
            $responseBody -> write($jsonData);
            return $response -> withStatus(200) -> withBody($responseBody);

        } catch (Exception $e) {
            $errorData = ['error' => $e -> getMessage()];
            $jsonError = json_encode($errorData);
            $response -> getBody() -> write($jsonError);
            return $response -> withStatus(400) -> withHeader('Content-Type', 'application/json');
        }
    });


    //? G) Eliminar una plataforma

    $app -> delete('/plataformas/{id}', function (Request $request, Response $response, $args) use ($db){
        try {
            $idPlataforma = $args['id'];

            $connection = $db -> getConnection();

            $sqlSelect = $connection -> prepare('SELECT COUNT(*) FROM `plataformas` WHERE id = ?');
            $sqlSelect -> execute([$idPlataforma]);
            $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);
            if(!($result[0]['COUNT(*)'] > 0)){
                throw new Exception ('No hay ningun registro que corresponda al ID especificado.');
            }

            $sqlDelete = $connection -> prepare('DELETE FROM `generos` WHERE id = ?');
            $sqlDelete -> execute([$idPlataforma]);

            $jsonData = json_encode('La plataforma fue eliminada con exito.');
            $response -> getBody() -> write($jsonData);
            return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
        } catch (Exception $e) {
            $errorData = json_encode(['error' => $e -> getMessage()]);
            $response -> getBody() -> write($errorData);
            return $response -> withStatus(400) -> withHeader('Content-Type', 'application/json');
        }
    });

    //? H) Obtener todas las plataformas

    $app -> get('/plataformas', function(Request $request, Response $response, $args) use ($db){
        try {
            $connection = $db -> getConnection();

            //? Chequear si está bien esta validación.
            if ($connection == null){
                throw new Exception ('No se puede conectar a la base de datos.');
            }

            $sqlGet = $connection -> prepare('SELECT * FROM `plataformas`');
            $sqlGet -> execute();
            $result = $sqlGet -> fetchAll(PDO::FETCH_ASSOC);

            $dataJson = json_encode($result);
            $response -> getBody() -> write($dataJson);
            return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
        } catch (Exception $e) {
            $errorData = ['error' => $e->getMessage()];
            $errorJson = json_encode($errorData. "CATCH");
            $response -> getBody() -> write($errorJson);
            //? Chequear si es error 404 o 400.
            return $response -> withStatus(404) -> withHeader('Content-Type', 'application/json');
        }
    });

    //? i) Crear un nuevo juego

    $app -> post('/juegos', function (Request $request, Response $response, $args) use ($db){
        try {
            $params = $request -> getParsedBody();
            $nombre = $params['nombre'];
            // $tipoImg = $params['img-juego']['type'];
            // $img = base64_encode(file_get_contents($params['img-juego']['tmp_name']));
            $descripcion = $params['descripcion'];
            $url = $params['url'];
            $plataforma = $params['plataforma'];
            $genero = $params['genero'];

            // VALIDACIONES
            $msgError = "";
            if ($nombre == ""){
                $msgError = $msgError.'El campo "nombre" es requerido. ';
            }
            // ------------------------
            // Acá las validaciones de imagenes
            // ------------------------
            if(strlen($descripcion) > 255){
                $msgError = $msgError.'El campo "descripción" no puede superar los 255 caracteres. ';
            }
            if(strlen($url) > 80){
                $msgError = $msgError.'El campo "url" no puede superar los 80 caracteres. ';
            }
            if($plataforma == ""){
                $msgError = $msgError.'El campo "plataforma" es requerido. ';
            }
            if($genero == ""){
                $msgError = $msgError.'El campo "genero" es requerido. ';
            }
            if (!$msgError == ""){
                throw new Exception ($msgError,400);
            }

            $connection = $db -> getConnection();

            $connection -> prepare("INSERT INTO `juegos`(`nombre`, `imagen`, `tipo_imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) VALUES ('?', '?','?','?','?', '?','?')");
            $connection -> execute([$nombre, $img, $tipo_imagen, $descripcion, $url, $plataforma, $genero]);

            $dataJson = json_encode('El juego fue agregado con exito.');
            $response -> getBody() -> write($dataJson);
            return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
        } catch (Exception $e) {
            $msgError = $e -> getMessage();
            $codeError = $e -> getCode();
            $jsonError = json_encode($msgError);
            $response -> getBody() -> write($jsonError);
            return $response -> withStatus($codeError) -> withHeader('Content-Type', 'application/json');
        }

        //? j) Actualizar información de un juego

        $app -> put('/juegos/{id}', function (Request $request, Response $response, $args) use ($db){
            $idJuego = $args['id'];


        });

        //? k) Eliminar un juego
        //? l) Obtener todos los juegos
        //? m) Buscar juegos
    });

    $app->run();
