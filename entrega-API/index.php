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

    //Investigar como mover todos los endpoints de genero a otro archivo y modularizarlo.

    //TODO Reemplazar returns por Excepciones.

    //? A) Crear un nuevo género

    $app -> post('/generos', function (Request $request, Response $response) use ($db) {
        //getBody obtiene todas las solicitudes enviadas al servidor (POST) en formato json
        $requestBody = $request -> getBody();
        //Transforma el json a un array y lo guarda en $data
        $data = json_decode($requestBody, true);
        //en $data estan todos las props que mandamos desde Postman
        if(isset($data['nombreGenero']) && strlen($data['nombreGenero'])){
            $nombreGenero = $data['nombreGenero'];
        } else {
            //Escribimos un error y lo encodeamos
            $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo nombreGenero es requerido']));
            //Retornamos una respuesta de tipo JSON con el codigo 400 y el cuerpo con el error
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        // Obtén la conexión a la base de datos el getConnection ya tiene un try/catch
        $connection = $db -> getConnection();

        try{
            $sqlInsert = $connection -> prepare("INSERT INTO `generos`(`nombre`) VALUES (?)");
            //Donde va el signo de pregunta es donde se inserta la variable
            $sqlInsert -> execute([$nombreGenero]);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrio un error al insertar el género en la base de datos']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        // Guarda el msj en un array y lo encodea a json
        $jsonData = json_encode(['message' => 'Genero creado exitosamente']);
        // Almacena la referencia al cuerpo de la respuesta en $responseBody
        $responseBody = $response -> getBody();
        // Escribe en el cuerpo de la respuesta el json guardado con el msj anteriormente
        $responseBody -> write($jsonData);
        // Retorna una respuesta HTTP con codigo 200 (éxito) y el cuerpo con el json
        return $response -> withStatus(200) -> withBody($responseBody);
    });

    //? B) Actualizar información de un género

    $app -> put('/generos/{id}', function (Request $request, Response $response, $args) use ($db){
        $requestBody = $request -> getBody();
        $data = json_decode($requestBody, true);

        if(isset($data['nombreGenero']) && strlen($data['nombreGenero'])){
            $nombreGenero = $data['nombreGenero'];
        } else {
            $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo nombreGenero es requerido']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        // Obtiene los datos que vienen por args"idGenero" y los guarda en las variables
        if(isset($args['id']) && is_numeric($args['id'])){
            $idGenero = $args['id'];
        } else {
            $response->getBody()->write(json_encode(['[400] Error: ' => 'El parametro id es requerido y tiene que ser un numero']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }
       
        $connection = $db -> getConnection();

        try{
            $sqlSelect = $connection -> prepare('SELECT COUNT(*) FROM `generos` WHERE id = ?');
            $sqlSelect -> execute([$idGenero]);

            $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);

            if(!$result[0]['COUNT(*)']){
                $response->getBody()->write(json_encode(['[404] Error: ' => 'No hay ningun registro con el ID especificado.']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }
            
            // Guarda en $sqlUpdate la query preparada para actualizar el genero de nombre=? y id=?
            $sqlUpdate = $connection -> prepare("UPDATE `generos` SET `nombre` = ? WHERE `id` = ?");
            $sqlUpdate -> execute([$nombreGenero, $idGenero]);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrio un error al actualizar el genero']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $jsonData =  json_encode(['message' => 'Genero actualizado exitosamente']);
        $response -> getBody() -> write($jsonData);
        return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
    });


    //? C) Eliminar un género

    $app->delete('/generos/{id}', function (Request $request, Response $response, $args) use ($db){
        if(isset($args['id']) && is_numeric($args['id'])){
            $idGenero = $args['id'];
        } else {
            $response->getBody()->write(json_encode(['[400] Error: ' => 'El parametro id es requerido y tiene que ser un numero']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $connection = $db -> getConnection();

        try{
            $sqlSelect = $connection -> prepare('SELECT COUNT(*) FROM `generos` WHERE id = ?');
            $sqlSelect -> execute([$idGenero]);

            $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);

            if(!$result[0]['COUNT(*)']){
                $response->getBody()->write(json_encode(['[404] Error: ' => 'No hay ningun registro con el ID especificado.']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }
            
            $sqlDelete = $connection -> prepare("DELETE FROM `generos` WHERE `id` = ?");
            $sqlDelete -> execute([$idGenero]);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrio un error al eliminar el genero. Revisa que no estes eliminando un genero que este asociado a un juego']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }


        $jsonData =  json_encode(['message' => 'Genero eliminado exitosamente']);
        $response -> getBody() -> write($jsonData);
        return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
    });

    //? D) Obtener todos los géneros

    $app -> get('/generos', function (Request $request, Response $response, $args) use ($db){
        $connection = $db -> getConnection();
        try{
            $sqlSelect = $connection -> prepare("SELECT DISTINCT * FROM `generos`");
            $sqlSelect -> execute();
        }catch (Exception $e) {
            $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrio un error al obtener los generos']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        // Obtengo los datos de la BD y los guardo en $result
        $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);
        $jsonData = json_encode($result);
        $responseBody = $response -> getBody();
        $responseBody -> write($jsonData);
        return $response -> withStatus(200) -> withBody($responseBody) -> withHeader('Content-Type', 'application/json');
    });

    //? E) Crear una nueva plataforma

    $app -> post('/plataformas', function (Request $request, Response $response, $args) use ($db){
            $requestBody = $request -> getBody();
            $data = json_decode($requestBody,true);

            if(isset($data['nombrePlataforma']) && strlen($data['nombrePlataforma'])){
                $nombrePlataforma = $data['nombrePlataforma'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo nombrePlataforma es requerido.']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            $connection = $db -> getConnection();

            try{
                $sqlInsert = $connection -> prepare("INSERT INTO `plataformas`(`nombre`) VALUES(?)");
                $sqlInsert -> execute([$nombrePlataforma]);
            } catch (Exception $e) {
                $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrio un error al crear una plataforma.']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }

            $jsonData =  json_encode(['message' => 'Plataforma creada exitosamente.']);
            $response -> getBody() -> write($jsonData);
            return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
    });

    //? F) Actualizar información de una plataforma

    $app -> put('/plataformas/{id}', function (Request $request, Response $response, $args) use ($db){
            $requestBody = $request -> getBody();
            $data = json_decode($requestBody, true);

            if(isset($data['nombrePlataforma']) && strlen($data['nombrePlataforma'])){
                $nombrePlataforma = $data['nombrePlataforma'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo nombrePlataforma es requerido']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            if(isset($args['id']) && is_numeric($args['id'])){
                $idPlataforma = $args['id'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El parametro id es requerido y tiene que ser un numero']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            $connection = $db -> getConnection();

            try{
                // Valido si el ID existe en la tabla plataformas, sino lanzo excepción.
                $sqlSelect = $connection -> prepare('SELECT COUNT(*) FROM `plataformas` WHERE id = ?');
                $sqlSelect -> execute([$idPlataforma]);

                $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);

                if(!$result[0]['COUNT(*)']){
                    $response->getBody()->write(json_encode(['[404] Error: ' => 'No hay ningun registro con el ID especificado.']));
                    return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
                }

                $sqlUpdate = $connection -> prepare('UPDATE `plataformas` SET `nombre` = ? WHERE id = ?');
                $sqlUpdate -> execute([$nombrePlataforma,$idPlataforma]);

            } catch (Exception $e) {
                $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrio un error al actualizar una plataforma.']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }

            $jsonData = json_encode(['message' => 'Plataforma se actualizo exitosamente.']);
            $response -> getBody() -> write($jsonData);
            return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
    });


    //? G) Eliminar una plataforma

    $app -> delete('/plataformas/{id}', function (Request $request, Response $response, $args) use ($db){
            if(isset($args['id']) && is_numeric($args['id'])){
                $idPlataforma = $args['id'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El parametro id es requerido y tiene que ser un numero']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }
            
            $connection = $db -> getConnection();

            try{
                $sqlSelect = $connection -> prepare('SELECT COUNT(*) FROM `plataformas` WHERE id = ?');
                $sqlSelect -> execute([$idPlataforma]);
                $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);

                if(!$result[0]['COUNT(*)']){
                    $response->getBody()->write(json_encode(['[404] Error: ' => 'No hay ningun registro que corresponda al ID especificado.']));
                    return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
                }

                $sqlDelete = $connection -> prepare('DELETE FROM `plataformas` WHERE id = ?');
                $sqlDelete -> execute([$idPlataforma]);

            } catch (Exception $e) {
                $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrio un error al eliminar una plataforma.']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }

            $jsonData =  json_encode(['message' => 'Plataforma fue eliminada con exito.']);
            $response -> getBody() -> write($jsonData);
            return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
    });

    //? H) Obtener todas las plataformas

    $app -> get('/plataformas', function(Request $request, Response $response, $args) use ($db){
        $connection = $db -> getConnection();
        try{
            $sqlGet = $connection -> prepare('SELECT * FROM `plataformas`');
            $sqlGet -> execute();
            $result = $sqlGet -> fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrio un error al obtener las plataformas.']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $dataJson = json_encode($result);
        $response -> getBody() -> write($dataJson);
        return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
    });

    //? i) Crear un nuevo juego

    $app -> post('/juegos', function (Request $request, Response $response, $args) use ($db){
            $requestBody = $request -> getBody();
            $params = json_decode($requestBody,true);

            //Nombre
            if(isset($params['nombre']) && strlen($params['nombre'])){
                $nombre = $params['nombre'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo nombre es requerido']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            //Descripcion
            if(isset($params['descripcion'])){
                if(strlen( $params['descripcion']) > 255){
                    $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo descripción no puede superar los 255 caracteres.']));
                    return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
                }
                $descripcion =  $params['descripcion'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo descripcion es requerido']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }
            
            //Url
            if(isset($params['url'])){
                if(strlen($params['url']) > 80){
                    $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo url no puede superar los 80 caracteres.']));
                    return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
                }
                $url = $params['url'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo url es requerido']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            //Plataforma
            if(isset($params['plataforma'])){
                $plataforma = $params['plataforma'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo plataforma es requerido']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            //Genero
            if(isset($params['genero'])){
                $genero = $params['genero'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo genero es requerido']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            //Imagen
            if(isset($params['img'])){
                $img = $params['img'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo imagen es requerido']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            //Type
            if(isset($params['tipoImagen'])){
                $tipoImagen = $params['tipoImagen'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo tipoImagen es requerido']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            $connection = $db -> getConnection();

            //Validacion plataformas
            try{
                $sqlSelect = $connection -> prepare('SELECT COUNT(*) FROM `plataformas` WHERE id = ?');
                $sqlSelect -> execute([$plataforma]);

                $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);

                if(!$result[0]['COUNT(*)']){
                    $response->getBody()->write(json_encode(['[404] Error: ' => 'No hay ningun registro con el ID especificado para la plataforma.']));
                    return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
                }

            } catch (Exception $e) {
                $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrio un error al buscar el ID de la plataforma.']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }

            //Validacion genero
            try{
                $sqlSelect = $connection -> prepare('SELECT COUNT(*) FROM `generos` WHERE id = ?');
                $sqlSelect -> execute([$genero]);

                $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);

                if(!$result[0]['COUNT(*)']){
                    $response->getBody()->write(json_encode(['[404] Error: ' => 'No hay ningun registro con el ID especificado para el genero.']));
                    return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
                }

            } catch (Exception $e) {
                $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrio un error al buscar el ID del genero.']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }

            try{
                $sqlInsertJuego = $connection->prepare("INSERT INTO `juegos`(`nombre`, `imagen`, `tipo_imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $sqlInsertJuego->execute([$nombre, $img, $tipoImagen, $descripcion, $url, $genero, $plataforma]);

            } catch (Exception $e) {
                $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrio un error al crear un juego.']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }

            $dataJson = json_encode(['message' => 'El juego fue creado con exito.']);
            $response -> getBody() -> write($dataJson);
            return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
    });

    //? j) Actualizar información de un juego

    $app -> put('/juegos/{id}', function (Request $request, Response $response, $args) use ($db){
            $requestBody = $request -> getBody();
            $params = json_decode($requestBody, true);

            $connection = $db -> getConnection();

            if(isset($args['id']) && is_numeric($args['id'])){
                $idJuegos = $args['id'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El parametro id es requerido y tiene que ser un numero']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            //Descripcion
            if(isset($params['descripcion'])){
                if(strlen( $params['descripcion']) > 255){
                    $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo descripción no puede superar los 255 caracteres.']));
                    return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
                }
                $descripcion =  $params['descripcion'];
            }
            
            //Url
            if(isset($params['url'])){
                if(strlen($params['url']) > 80){
                    $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo url no puede superar los 80 caracteres.']));
                    return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
                }
                $url = $params['url'];
            }

            //Imagen
            if(isset($params['img'])){
                $img = $params['img'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo imagen es requerido']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            //Type
            if(isset($params['tipoImagen'])){
                $tipoImagen = $params['tipoImagen'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El campo tipoImagen es requerido']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }


            //Plataforma
            if(isset($params['plataforma'])){
                $sqlSelect = $connection -> prepare('SELECT COUNT(*) FROM `plataformas` WHERE id = ?');
                $sqlSelect -> execute([$params['plataforma']]);
                $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);
                if (!$response){
                    $response->getBody()->write(json_encode(['[404] Error: ' => 'No hay ningun registro que corresponda al ID especificado.']));
                    return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
                }
                $plataforma = $params['plataforma'];
            }


            if(isset(($params['genero']))){
                $sqlSelect = $connection -> prepare('SELECT COUNT(*) FROM `generos` WHERE id = ?');
                $sqlSelect -> execute([$params['genero']]);
                $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);
                if (!$response){
                    $response->getBody()->write(json_encode(['[404] Error: ' => 'No hay ningun registro que corresponda al ID especificado.']));
                    return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
                }
                $genero = $params['genero'];
            }
            
            try {
                $sqlSelect = $connection->prepare('SELECT COUNT(*) FROM `juegos` WHERE `id` = ?');
                $sqlSelect->execute([$idJuegos]);
                $result = $sqlSelect->fetchAll(PDO::FETCH_ASSOC);
        
                if (!$result) {
                    $response->getBody()->write(json_encode(['[404] Error: ' => 'No hay ningún registro que corresponda al ID especificado.']));
                    return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
                }
        
                $sqlUpdate = $connection->prepare("UPDATE `juegos` SET `nombre` = ?, `descripcion` = ?, `url` = ?, `id_plataforma` = ?, `id_genero` = ?, `imagen` = ?, `tipo_imagen` = ? WHERE `id` = ?");
                $sqlUpdate->execute([$params['nombre'], $descripcion, $url, $plataforma, $genero, $img, $tipoImagen, $idJuegos]);                
            } catch (Exception $e) {
                $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrió un error al actualizar el juego.']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }
        

            $dataJson = json_encode(['message' => 'El juego fue actualizado con exito.']);
            $response -> getBody() -> write($dataJson);
            return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
    });

    //? k) Eliminar un juego
    
    $app -> delete('/juegos/{id}', function (Request $request, Response $response, $args) use ($db){
            if(isset($args['id']) && is_numeric($args['id'])){
                $idJuego = $args['id'];
            } else {
                $response->getBody()->write(json_encode(['[400] Error: ' => 'El parametro id es requerido y tiene que ser un numero']));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }

            $connection = $db -> getConnection();

            try{
                // Validacion de ID
                $sqlSelect = $connection -> prepare('SELECT COUNT(*) FROM `juegos` WHERE `id` = ?');
                $sqlSelect -> execute([$idJuego]);
                $result = $sqlSelect -> fetchAll(PDO::FETCH_ASSOC);
                if (!$result) {
                    $response->getBody()->write(json_encode(['[404] Error: ' => 'No hay ningún registro que corresponda al ID especificado.']));
                    return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
                }
            }catch(Exception $e){
                $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrió un error al encontrar el juego a eliminar.']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }

            try{
                $sqlDelete = $connection -> prepare('DELETE FROM `juegos` WHERE `id` = ?');
                $sqlDelete -> execute([$idJuego]);
            }catch(Exception $e){
                $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrió un error al eliminar el juego.']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }

            $dataJson = json_encode(['message' => 'El juego fue eliminado con exito.']);
            $response -> getBody() -> write($dataJson);
            return $response -> withStatus(200) -> withHeader('Content-Type', 'application/json');
    });


    //? l) Obtener todos los juegos
    //? m) Buscar juegos

    $app->get('/juegos', function(Request $request, Response $response, $args) use ($db) {
        $params = $request -> getQueryParams();
        print_r($params);

        $query = "SELECT j.nombre as nombrejuego, j.imagen, j.tipo_imagen, j.descripcion, j.url, g.nombre as nombregenero, p.nombre as nombrePlataforma FROM juegos j INNER JOIN generos g ON j.id_genero = g.id INNER JOIN plataformas p ON j.id_plataforma = p.id WHERE 1 = 1";

        if (!empty($params)) {
            if (isset($params["genero"]) && strlen($params["genero"])) {
                $genero = $params["genero"];
                $query = $query . " AND g.id = $genero";
            }
            if (isset($params["plataforma"]) && strlen($params["plataforma"])) {
                $plataforma = $params["plataforma"];
                $query = $query . " AND p.id = $plataforma";
            }
            if (isset($params["nombre"]) && strlen($params["nombre"])) {
                $nombre = $params["nombre"];
                $query = $query . " AND j.nombre LIKE '%$nombre%'"; // Devuelve todos los matcheos.
            }
            if (isset($params["ordenar"]) && strlen($params["ordenar"])) {
                $orden = $params["ordenar"];
                $query = $query . " ORDER BY j.nombre $orden";
            }
        }

        $connection = $db->getConnection();
        try {
            $sqlSelect = $connection->prepare($query);
            $sqlSelect->execute();
            $data = $sqlSelect->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['[404] Error: ' => 'Ocurrió un error al encontrar los juegos.']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $dataJson = json_encode(['Lista de juegos encontrados' => $data]);
        $response->getBody()->write($dataJson);
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    });


    $app->run();
