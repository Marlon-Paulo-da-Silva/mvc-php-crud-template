<?php

use App\Http\Response;

use App\Controller\Pages;

$obRouter->get('/',[
  function(){
    return new Response(200, Pages\Home::getHome());
  }
]);

$obRouter->get('/sobre',[
  function(){
    return new Response(200, Pages\About::getAbout());
  }
]);

$obRouter->get('/depoimentos',[
  function($request, $obPagination){
    return new Response(200, Pages\Testimony::getTestimonies($request, $obPagination));
  }
]);

// Rota de depoimentos (INSERT)
$obRouter->post('/depoimentos',[
  function($request){
    
    return new Response(200, Pages\Testimony::insertTestimony($request));
  }
]);

// Rota dinamica
// $obRouter->get('/pagina/{idPagina}/{acao}',[
//   function($idPagina, $acao){
//     return new Response(200, "Pagina: " . $idPagina . " - Ação: " . $acao);
//   }
// ]);

// $obRouter->get('/user/edit/{idUser}/{teste}/',[
//   function($idPagina, $teste){
//     return new Response(200, 'Pagina: ' . $idPagina . ' - Teste: ' . $teste);
//   }
// ]);