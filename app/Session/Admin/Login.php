<?php

namespace App\Session\Admin;

class Login {

  // Metodo responsável por iniciar a sessão
  private static function init(){

    // Verifica se a sessão não está ativa
    if(session_status() != PHP_SESSION_ACTIVE){
      session_start();
    }
  }

  //Metodo responsável por criar o login do usuário
  public static function login($obUser){

    self::init();

    // Define a sessão do usuário
    $_SESSION['admin']['user'] = [
      'id_client' => $obUser->id_client,
      'username' => $obUser->username,
      'email' => $obUser->email
    ];

    // Sucesso
    return true;
  }

  // Metodo responsável por verificar se o usuário está logado 
  public static function isLogged(){

    // inicia a sessão
    self::init();

    // Retorna a verificação
    return isset($_SESSION['admin']['user']['id_client']);
  }

  // Metodo responsável por deslogar o usuário
  public static function logout(){
    // Inicia a sessão
    self::init();

    // desloga o usuário
    unset($_SESSION['admin']['user']);

    // sucesso
    return true;
  }
}

?>