<?php

namespace App\Http\Middleware;

use App\Session\Admin\Login as SessionAdminLogin;

class RequireAdminLogin{
  // Metodo responsável por executar o Middleware
  public function handle($request, $next){
    // Verifica se o usuário está Logado
    if(!SessionAdminLogin::isLogged()){
      $request->getRouter()->redirect('/admin/login');
    }

    return $next($request);
  }
}


?>