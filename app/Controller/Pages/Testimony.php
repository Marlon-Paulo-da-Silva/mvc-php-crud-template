<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Model\Entity\Testimony as EntityTestimony;
use App\Db\Pagination;

class Testimony extends Page {

  public static function getTestimonyItems($request, &$obPagination){
    //depoimentos
    $items = '';

    // quantidade total de registros
    $totalQuantity = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtde')->fetchObject()->qtde;

    // pagina atual
    $queryParams = $request->getQueryParams();
    $pageAtual = $queryParams['page'] ?? 1;

    //instancia de paginação (define a quantidade total, pagina atual, quant. paginas)
    $obPagination = new Pagination($totalQuantity, $pageAtual, 3);

    $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

    // Renderiza o item
    while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
      $content = View::render('pages/testimony/item',[
        'name' => $obTestimony->name,
        'date' => date('d/m/Y H:i:s', strtotime($obTestimony->date)),
        'message' => $obTestimony->message
      ]);
      
      $items .= $content;
    }
    

    // retorna os depoimentos
    return $items;
  }

  public static function getTestimonies($request){
    $content = View::render('pages/testimonies', [
      'items' => self::getTestimonyItems($request, $obPagination),
      'pagination' => parent::getPagination($request, $obPagination)
    ]);

    // retorna a view da pagina
    return parent::getPage('DEPOIMENTOS',$content);
  }

  public static function insertTestimony($request){
    //Dados do post
    $postVars = $request->getPostVars();
    
    //nova instancia de depoimento
    $obTestimony = new EntityTestimony;
    $obTestimony->name = $postVars['name'];
    $obTestimony->message = $postVars['message'];
    $obTestimony->cadastrar();
    
    // retorna a página de listagem de depoimentos
    return self::getTestimonies($request);
  }
  
}