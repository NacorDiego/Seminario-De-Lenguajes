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
    $db->connect();

    //Todas las funciones se repiten pero cambian pocas cosas, falta agregar errores 404 y 400. Por ahora esta todo sin catchear errores
    //Investigar como mover todos los endpoints de genero a otro archivo y modularizarlo.
    $app->post('/agregarGeneros', function (Request $request, Response $response, $args) use ($db) {
        //getBody obtiene todas las solicitudes enviadas al servidor (POST) //Modularizar
        $responseBody = $request->getBody();
        //json_decode convierte el json en un array asociativo (basicamente que PHP pueda interpretar la data JSON)
        $data = json_decode($body, true);
        //en $data estan todos las props que mandamos desde Postman
        $nombreGenero = $data['nombreGenero'];
    
        // Obtén la conexión a la base de datos
        $connection = $db->getConnection();
    
        // Insertar el nuevo género en la base de datos
        $sqlInsert = $connection->prepare("INSERT INTO `generos`(`nombre`) VALUES (?)");
        // Agregar try/catch si falla el execute con 404 creo
        //Donde va el signo de pregunta es donde se inserta la variable
        $sqlInsert->execute([$nombreGenero]);
    
        // Devolver una respuesta exitosa // Modularizar
        $jsonData = json_encode(['message' => 'Genero creado exitosamente']);
        $responseBody->write($jsonData);
        return $response->withStatus(200)->withBody($responseBody);
    });


    $app->post('/actualizarGenero', function (Request $request, Response $response, $args) use ($db){
        $body = $request->getBody();
        $data = json_decode($body, true);
        $nombreGenero = $data['nombreGenero'];
        $idGenero = $data['idGenero'];

        $connection = $db->getConnection();

        $sqlUpdate = $connection->prepare("UPDATE `generos` SET `nombre` = ? WHERE `id` = ?");
        $sqlUpdate->execute([$nombreGenero, $idGenero]);

        $jsonData = json_encode(['message' => 'Genero actualizado exitosamente']);
        $responseBody = $response->getBody();
        $responseBody->write($jsonData);
        return $response->withStatus(200)->withBody($responseBody);
    });

    $app->post('/eliminarGenero', function (Request $request, Response $response, $args) use ($db){
        $body = $request->getBody();
        $data = json_decode($body, true);
        $idGenero = $data['idGenero'];

        $connection = $db->getConnection();

        $sqlUpdate = $connection->prepare("DELETE FROM `generos` WHERE `id` = ?");
        $sqlUpdate->execute([$idGenero]);

        $jsonData = json_encode(['message' => 'Genero elimnado exitosamente']);
        $responseBody = $response->getBody();
        $responseBody->write($jsonData);
        return $response->withStatus(200)->withBody($responseBody);
    });

    $app->run();
