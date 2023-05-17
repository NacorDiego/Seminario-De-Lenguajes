<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;

    //Se encarga de cargar automaticamente todas las clases y dependencias definidas en tu proyecto PHP.
    require __DIR__ . '/vendor/autoload.php';

    $app = AppFactory::create();

    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello, world!");
        return $response;
    });

    // Incluir el archivo que contiene la clase Db
    require 'src/Models/db.php'; 
    // Crear una instancia de la clase Db
    $db = new Db(); 

    // Llamar al método connect()
    $db->connect();

    // echo $db -> connect();

    $app->run();
?>


