<?php

namespace App\Controller\Pages;

use App\Utils\View;

class Page {

  private static function getHeader(){
    return View::render('pages/header');
  }

  private static function getFooter(){
    return View::render('pages/footer');
  }

  // metodo renderiza o layout de paginação
  public static function getPagination($request, $obPagination){
    //paginas
    $pages = $obPagination->getPages();
    
    // Verifica a quantidade de Paginas
    if(count($pages) <= 1){
      return '';
    }

    //Links
    $links = '';

    //URL Atual (SEM GETS)
    $url = $request->getRouter()->getCurrentUrl();

    // GET
    $queryParams = $request->getQueryParams();

    // Renderiza os links
    foreach ($pages as $page) {
      // altera a página
      $queryParams['page'] = $page['page'];

      //Link
      $link = $url . '?' . http_build_query($queryParams);

      // View
      $links .= View::render('pages/pagination/link', [
        'link' => $link,
        'page' => $page['page'],
        'active' => $page['current'] ? 'active' : ''
      ]);

      
    }
    // echo $links;
    // exit;

    // Renderiza box de paginação
    return View::render('pages/pagination/box', [
      'links' => $links
    ]);
  }


  public static function getPage($title, $content){
    return View::render('pages/page', [
      'title' => $title,
      'header' => self::getHeader(),
      'content' => $content,
      'footer' => self::getFooter(),
    ]);
  }
}