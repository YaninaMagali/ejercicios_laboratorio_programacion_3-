<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

require_once './db/DAO.php';
require_once './controllers/LoginController.php';
require_once './controllers/CriptoController.php';
require_once './controllers/VentaController.php';
require_once './middlewares/ValidadorMdw.php';



// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Routes
$app->group('/login', function (RouteCollectorProxy $group) {
    // $group->get('[/]', \UsuarioController::class . ':TraerTodos');
    // $group->get('/{usuario}', \UsuarioController::class . ':TraerUno');
    $group->post('[/]', \LoginController::class . ':ValidarCredenciales');
    $group->post('/login', \LoginController::class . ':ValidarPerfilToken');
  });

  $app->group('/cripto', function (RouteCollectorProxy $group) {
    $group->get('/id/{id}', \CriptoController::class . ':ListarCriptosPorId')->add(\ValidadorMdw::class . ':ValidarExisteToken');
    $group->get('[/]', \CriptoController::class . ':ListarCriptos');
    $group->get('/{nacionalidad}', \CriptoController::class . ':ListarCriptosPorNacionalidad');
    // $group->get('/{usuario}', \UsuarioController::class . ':TraerUno');
    $group->post('[/]', \CriptoController::class . ':CrearCripto')->add(\ValidadorMdw::class . ':ValidarEsAdmin');
    //$group->post('/login', \LoginController::class . ':ValidarUsuarioToken');
  });


  $app->group('/venta', function (RouteCollectorProxy $group) {
    // $group->get('/id/{id}', \CriptoController::class . ':ListarCriptosPorId')->add(\ValidadorMdw::class . ':ValidarExisteToken');
    // $group->get('[/]', \CriptoController::class . ':ListarCriptos');
    // $group->get('/{nacionalidad}', \CriptoController::class . ':ListarCriptosPorNacionalidad');
    // $group->get('/{usuario}', \UsuarioController::class . ':TraerUno');
    $group->post('[/]', \VentaController::class . ':CrearVenta')->add(\ValidadorMdw::class . ':ValidarExisteToken');
    //$group->post('/login', \LoginController::class . ':ValidarUsuarioToken');
  });

$app->run();
