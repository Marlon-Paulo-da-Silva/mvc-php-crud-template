<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Utils\Uri;
use App\Utils\View;
use App\Utils\Environment;
use App\Db\Database;
use App\Http\Middleware\Queue as MiddlewareQueue;

//LOAD ENVIRONMENT VARS FROM FILE ON ROOT
Environment::load(__DIR__.'/../');

// $pagination = new Pagination('');

//Define as configurações do banco de dados
Database::config(
  getenv('DB_HOST'),
  getenv('DB_NAME'),
  getenv('DB_USER'),
  getenv('DB_PASS'),
  getenv('DB_PORT')
);


$base = new URI();
// $base =  strtolower($base->base());
$base = $base->base();


// define('URL', 'http://localhost/mvc-php');
define('URL', $base);



// Define o valor padrão das variáveis
View::init([
  'URL' => URL
]);

//Define o mapeamento de Middlewares
MiddlewareQueue::setMap([
  'maintenance' => \App\Http\Middleware\Maintenance::class,
  'require-admin-logout' => \App\Http\Middleware\RequireAdminLogout::class,
  'require-admin-login' => \App\Http\Middleware\RequireAdminLogin::class
]);

//Define o mapeamento de Middlewares PADRÕES (EXECUTADOS EM TODAS AS ROTAS)
MiddlewareQueue::setDefault([
  'maintenance'
]);
?>