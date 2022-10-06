<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Entity\User as EntityUser;
use App\Session\Admin\Login as SessionAdminLogin;
use App\Model\Entity\Testimony as EntityTestimony;
use App\Db\Pagination;

class User extends Page{

  // Metodo responsável por obter a renderização dos itens de usuário para a página
  public static function getUserItems($request, &$obPagination){
    //depoimentos
    $items = '';

    // quantidade total de registros
    $totalQuantity = EntityUser::getUsers(null, null, null, 'COUNT(*) as qtde')->fetchObject()->qtde;

    // pagina atual
    $queryParams = $request->getQueryParams();
    $pageAtual = $queryParams['page'] ?? 1;

    //instancia de paginação (define a quantidade total, pagina atual, quant. paginas)
    $obPagination = new Pagination($totalQuantity, $pageAtual, 5);
    
    $results = EntityUser::getUsers(null, 'id_client DESC', $obPagination->getLimit());

    // Renderiza o item
    while ($obUser = $results->fetchObject(EntityUser::class)) {
      $content = View::render('admin/modules/users/item',[
        'id' => $obUser->id_client,
        'name' => $obUser->client_name,
        'username' => $obUser->username,
        'email' => $obUser->email,
        'date' => $obUser->created_at,
      ]);
      
      $items .= $content;
    } 

    // retorna os depoimentos
    return $items;
  }
  
  // Metodo responsável por renderizar a view de listagem de depoimentos
  public static function getUsers($request){
    // Conteúdo da Home
    $content = View::render('admin/modules/users/index',[
      'itens' => self::getUserItems($request, $obPagination),
      'pagination' => parent::getPagination($request, $obPagination),
      'status' =>  self::getStatus($request)
    ]);

    // Retorna a pagina completa
    return parent::getPanel('Usuários > Inicial', $content,'users');
  }

  // Metodo responsável por retornar o formulário de cadastro de um novo usuário
  public static function getNewUser($request){
    
    // conteúdo do formulário
    $content = View::render('admin/modules/users/form',[
      'title' => 'Cadastrar usuário',
      'client_name' => '',
      'username' => '',
      'email' => '',
      'status' => self::getStatus($request)
    ]);

    return parent::getPanel('Cadastrar usuário > Marlon', $content, 'users');
  } 

  // Metodo responsável por cadastrar um usuário no banco
  public static function setNewUser($request){
    // Post vars
    $postVars = $request->getPostVars();

    $client_name  = $postVars['client_name'] ?? '';
    $username  = $postVars['username'] ?? '';
    $email  = $postVars['email'] ?? '';
    $passwrd  = $postVars['passwrd'] ?? '';

        
    // Valida o e-mail do usuário
    $obUser = EntityUser::getUserByEmail($email);
    if($obUser instanceof EntityUser){
      // Redireciona o usuário
      $request->getRouter()->redirect('/admin/users/new?status=duplicated');
    }
    
    // Nova instancia de usuário
    $obUser = new EntityUser;
    $obUser->client_name  = $client_name;
    $obUser->username  = $username;
    $obUser->email  = $email;
    $obUser->passwrd  = password_hash($passwrd, PASSWORD_DEFAULT);
    $obUser->create();

    
    // Redireciona o usuário
    $request->getRouter()->redirect('/admin/users/'.$obUser->id_client.'/edit?status=created');
  } 


  // Metodo responsável por retornar o formulário de edição do depoimento
  public static function getEditUser($request, $id){
    // Obtém o usuário do banco de dados
    $obUser = EntityUser::getUserById($id);
    
    // valida a instancia
    if(!$obUser instanceof EntityUser){
      $request->getRouter()->redirect('/admin/users');
    }
    
    // Conteúdo do formulário
    $content = View::render('admin/modules/users/form',[
      'title' => 'Editar usuário',
      'client_name' => $obUser->client_name,
      'username' => $obUser->username,
      'email' => $obUser->email,
      'status' => self::getStatus($request)
    ]); 


    // Retorna a pagina completa
    return parent::getPanel('Editar usuário > Inicial', $content,'users');
  
  }

  // Metodo responsável por gravar a alteração de um usuário
  public static function setEditUser($request, $id){
    // Obtém o depoimento do banco de dados
    $obUser = EntityUser::getUserById($id);

    // valida a instancia
    if(!$obUser instanceof EntityUser){
      $request->getRouter()->redirect('/admin/users');
    }
    
    //Postvars
    $postVars = $request->getPostVars();
    
    $client_name  = $postVars['client_name'] ?? '';
    $username  = $postVars['username'] ?? '';
    $email  = $postVars['email'] ?? '';
    $passwrd  = $postVars['passwrd'] ?? '';

        
    // Valida o e-mail do usuário
    $obUserEmail = EntityUser::getUserByEmail($email);

    if($obUserEmail instanceof EntityUser && $obUserEmail->id_client != $id){
      // Redireciona o usuário
      $request->getRouter()->redirect('/admin/users/'.$id.'/edit?status=duplicated');
    }  
    
    // Atualiza a instancia
    $obUser->client_name = $client_name ?? $obUser->client_name;
    $obUser->username = $username ?? $obUser->username;
    $obUser->email = $email ?? $obUser->email;
    $obUser->passwrd = password_hash($postVars['passwrd'] ?? $obUser->passwrd, PASSWORD_DEFAULT);   
    $obUser->update();

    // Redireciona o usuário
    $request->getRouter()->redirect('/admin/users/'.$obUser->id_client.'/edit?status=updated');
  }

  // Metodo responsável por retornar o formulário de exclusão do usuário
  public static function getDeleteUser($request, $id){
    // Obtém o usuário do banco de dados
    $obUser = EntityUser::getUserById($id);

    // valida a instancia
    if(!$obUser instanceof EntityUser){
      $request->getRouter()->redirect('/admin/users');
    }
    
    // Conteúdo do formulário
    $content = View::render('admin/modules/users/delete',[
      'client_name' => $obUser->client_name,
      'username' => $obUser->username
    ]);

    // Retorna a pagina completa
    return parent::getPanel('Excluir usuário > Inicial', $content,'users');
  
  }

  // Metodo responsável por excluir um depoimento
  public static function setDeleteUser($request, $id){
    // Obtém o usuário do banco de dados
    $obUser = EntityUser::getUserById($id);

    // valida a instancia
    if(!$obUser instanceof EntityUser){
      $request->getRouter()->redirect('/admin/users');
    }
    
    // excluir o depoimento
    $obUser->exclude();

    // Redireciona o usuário
    $request->getRouter()->redirect('/admin/users?status=deleted');
  
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
        return Alert::getSuccess('Usuário criado com sucesso !');
        break;
      case 'updated':
        return Alert::getSuccess('Usuário atualizado com sucesso !');
        break;
      case 'deleted':
        return Alert::getSuccess('Usuário excluído com sucesso !');
        break;
      case 'duplicated':
        return Alert::getError('O e-mail digitado já está sendo usado por outro usuário');
        break;
    }
  }
}