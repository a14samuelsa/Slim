<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';
$app = new \Slim\App;
require "../src/rutas/empleados.php";


$app->get('/', function (Request $request, Response $response, array $args) {
    //$name = $args['name'];
    $response->getBody()->write("Página de gestión API REST de la aplicación de tu Samuel Souto Arias");

    return $response;
});
$app->run();
?>
