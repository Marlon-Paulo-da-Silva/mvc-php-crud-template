<?php

namespace App\Controller\Chaves;

use App\Utils\View;
use App\Model\Entity\Organization;

class Home extends Page {
  public static function getHome(){

    $obOrganization = new Organization;

    
    $content = View::render('chaves/home', [
      'name' => $obOrganization->name,
    ]);

    return parent::getPage('Chaves Inicial',$content);
  }
}