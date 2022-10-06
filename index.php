<?php

include __DIR__ . '/includes/app.php';
use App\Http\Router;

// inicia o Router
$obRouter = new Router(URL); 

// inclui as rotas do site
include __DIR__ . '/app/Routes/pages.php';

// inclui as rotas do painel
include __DIR__ . '/app/Routes/admin.php';

$obRouter->run()
          ->sendResponse();