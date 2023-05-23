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

    //? Chequear si los args se pueden borrar
    $app -> post('/agregarGeneros', function (Request $request, Response $response) use ($db) {
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

    //? Chequear si los args se pueden borrar
    $app->post('/actualizarGenero', function (Request $request, Response $response) use ($db){
        // Obtiene la petición en formato json
        $requestBody = $request -> getBody();
        // Transforma el json a un array y lo guarda en $data
        $data = json_decode($requestBody, true);
        // Obtiene los datos que vienen en "nombreGenero" e "idGenero" y los guarda en las variables
        $nombreGenero = $data['nombreGenero'];
        $idGenero = $data['idGenero'];

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

    //? Chequear si los args se pueden borrar
    $app->delete('/generos/{id}', function (Request $request, Response $response, $args) use ($db){
        $idGenero = $args['id'];

        $connection = $db -> getConnection();

        $sqlDelete = $connection -> prepare("DELETE FROM `generos` WHERE `id` = ?");
        $sqlDelete -> execute([$idGenero]);

        $jsonData = json_encode(['message' => 'Genero elimnado exitosamente']);
        $responseBody = $response -> getBody();
        $responseBody -> write($jsonData);
        return $response -> withStatus(200) -> withBody($responseBody);
    });

    //? Chequear si request debe ir o se puede borrar en los param
    $app -> get('/generos', function (Request $request, Response $response, $args) use ($db){
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

    $app->run();
