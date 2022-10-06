<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Entity\User;
use App\Session\Admin\Login as SessionAdminLogin;
use App\Model\Entity\Testimony as EntityTestimony;
use App\Db\Pagination;

class Testimony extends Page{

  public static function getTestimonyItems($request, &$obPagination){
    //depoimentos
    $items = '';

    // quantidade total de registros
    $totalQuantity = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtde')->fetchObject()->qtde;

    
    // pagina atual
    $queryParams = $request->getQueryParams();
    $pageAtual = $queryParams['page'] ?? 1;

    //instancia de paginação (define a quantidade total, pagina atual, quant. paginas)
    $obPagination = new Pagination($totalQuantity, $pageAtual, 5);
    
    $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

    // Renderiza o item
    while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
      
      $content = View::render('admin/modules/testimonies/item',[
        'id' => $obTestimony->id,
        'name' => $obTestimony->name,
        'date' => date('d/m/Y H:i:s', strtotime($obTestimony->date)),
        'message' => $obTestimony->message
      ]);
      
      $items .= $content;
    } 

    // retorna os depoimentos
    return $items;
  }
  
  // Metodo responsável por renderizar a view de listagem de depoimentos
  public static function getTestimonies($request){
    // Conteúdo da Home
    $content = View::render('admin/modules/testimonies/index',[
      'itens' => self::getTestimonyItems($request, $obPagination),
      'pagination' => parent::getPagination($request, $obPagination),
      'status' =>  self::getStatus($request)
    ]);

    // Retorna a pagina completa
    return parent::getPanel('Depoimentos > Inicial', $content,'testimonies');
  }

  // Metodo responsável por retornar o formulário de cadastro de um novo depoimento
  public static function getNewTestimony($request){
    
    // conteúdo do formulário
    $content = View::render('admin/modules/testimonies/form',[
      'title' => 'Cadastrar depoimento',
      'name' => '',
      'message' => '',
      'status' => ''
    ]);

    return parent::getPanel('Cadastrar depoimento > Marlon', $content, 'testimonies');
  } 

  // Metodo responsável por cadastrar um depoimento no banco
  public static function setNewTestimony($request){
    // Post vars
    $postVars = $request->getPostVars();

    // Nova instancia de depoimento
    $obTestimony = new EntityTestimony;
    $obTestimony->name  = $postVars['name'] ?? '';
    $obTestimony->message  = $postVars['message'] ?? '';
    $obTestimony->cadastrar();

    // Redireciona o usuário
    $request->getRouter()->redirect('/admin/testimonies/'.$obTestimony->id.'/edit?status=created');
  } 

  // Metodo responsável por retornar a mensagem
  private static function getStatus($request){
    // Query Params
    $queryParams = $request->getQueryParams();

    // Status
    if(!isset($queryParams['status'])) return '';

    // Mensagens de status
    switch ($queryParams['status']) {
      case 'created':
        return Alert::getSuccess('Depoimento criado com sucesso !');
        break;
      case 'updated':
        return Alert::getSuccess('Depoimento atualizado com sucesso !');
        break;
      case 'deleted':
        return Alert::getSuccess('Depoimento excluído com sucesso !');
        break;
    }
  }

  // Metodo responsável por retornar o formulário de edição do depoimento
  public static function getEditTestimony($request, $id){
    // Obtém o depoimento do banco de dados
    $obTestimony = EntityTestimony::getTestimonyById($id);

    // valida a instancia
    if(!$obTestimony instanceof EntityTestimony){
      $request->getRouter()->redirect('/admin/testimonies');
    }
    
    // Conteúdo do formulário
    $content = View::render('admin/modules/testimonies/form',[
      'title' => 'Editar depoimento',
      'name' => $obTestimony->name,
      'message' => $obTestimony->message,
      'status' => self::getStatus($request)
    ]);

    // Retorna a pagina completa
    return parent::getPanel('Editar depoimento > Inicial', $content,'testimonies');
  
  }

  // Metodo responsável por gravar a alteração de um depoimento
  public static function setEditTestimony($request, $id){
    // Obtém o depoimento do banco de dados
    $obTestimony = EntityTestimony::getTestimonyById($id);

    // valida a instancia
    if(!$obTestimony instanceof EntityTestimony){
      $request->getRouter()->redirect('/admin/testimonies');
    }
    
    //Postvars
    $postVars = $request->getPostVars();

    // Atualiza a instancia
    $obTestimony->name = $postVars['nome'] ?? $obTestimony->name;
    $obTestimony->message = $postVars['message'] ?? $obTestimony->message;
    $obTestimony->atualizar();

    // Redireciona o usuário
    $request->getRouter()->redirect('/admin/testimonies/'.$obTestimony->id.'/edit?status=updated');
  }

  // Metodo responsável por retornar o formulário de exclusão do depoimento
  public static function getDeleteTestimony($request, $id){
    // Obtém o depoimento do banco de dados
    $obTestimony = EntityTestimony::getTestimonyById($id);

    // valida a instancia
    if(!$obTestimony instanceof EntityTestimony){
      $request->getRouter()->redirect('/admin/testimonies');
    }
    
    // Conteúdo do formulário
    $content = View::render('admin/modules/testimonies/delete',[
 
      'name' => $obTestimony->name,
      'message' => $obTestimony->message
    ]);

    // Retorna a pagina completa
    return parent::getPanel('Excluir depoimento > Inicial', $content,'testimonies');
  
  }

  // Metodo responsável por excluir um depoimento
  public static function setDeleteTestimony($request, $id){
    // Obtém o depoimento do banco de dados
    $obTestimony = EntityTestimony::getTestimonyById($id);

    // valida a instancia
    if(!$obTestimony instanceof EntityTestimony){
      $request->getRouter()->redirect('/admin/testimonies');
    }
    
    // excluir o depoimento
    $obTestimony->excluir();

    // Redireciona o usuário
    $request->getRouter()->redirect('/admin/testimonies?status=deleted');
  
  }
}