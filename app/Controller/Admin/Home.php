<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Entity\User;
use App\Session\Admin\Login as SessionAdminLogin;

class Home extends Page{
  
  //Metodo responsável por renderizar a view de Home do painel
  public static function getHome($request){
    // Conteúdo da Home
    $content = View::render('admin/modules/home/index',[]);

    // Retorna a pagina completa
    return parent::getPanel('Home > Inicial', $content,'home');
  }

}