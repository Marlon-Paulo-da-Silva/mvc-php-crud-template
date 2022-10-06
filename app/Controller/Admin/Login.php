<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Entity\User;
use App\Session\Admin\Login as SessionAdminLogin;

class Login extends Page{
  
  //Metodo retornar a renderização da página de login
  public static function getLogin($request, $errorMessage = null){

    //Status
    $status = !is_null($errorMessage) ? Alert::getError($errorMessage) : '';

    // Conteudo da página de login
    $content = View::render('admin/login', [
      'status' => $status
    ]);

    //Retorna a página completa

    return parent::getPage('Login - Sistma', $content);
  }

  //Metodo responsável por definir o login do ususáreio
  public static function setLogin($request){

    // postVars que estão os dados vindo do POST
    $postVars = $request->getPostVars();
    $email = $postVars['email'] ?? '';
    $passwrd = $postVars['passwrd'] ?? '';


    // Busca o usuário pelo e-mail
    $obUser = User::getUserByEmail($email);
    if (!$obUser instanceof User) {
      return self::getLogin($request, 'E-mail ou senha inválidos');
    }

    // Verifica a senha do Usuário
    if(!password_verify($passwrd, $obUser->passwrd)){
      return self::getLogin($request, 'E-mail ou senha inválidos');
    }

    // Cria a sessão de login
    SessionAdminLogin::login($obUser);

    // redireciona o usuário para a Home Admin
    $request->getRouter()->redirect('/admin');
    
  }

  // Metodo responsável por deslogar o usuário
  public static function setLogout($request){

    // Destroi a sessão de login
    SessionAdminLogin::logout();

    // redireciona o usuário para a tela de login
    $request->getRouter()->redirect('/admin/login');
  }
}