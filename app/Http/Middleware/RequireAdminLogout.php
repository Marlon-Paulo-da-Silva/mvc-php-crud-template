<?php

namespace App\Http\Middleware;

use App\Session\Admin\Login as SessionAdminLogin;

class RequireAdminLogout{
  // Metodo responsável por executar o Middleware
  public function handle($request, $next){
    // Verifica se o usuário está Logado
    if(SessionAdminLogin::isLogged()){
      $request->getRouter()->redirect('/admin');
    }

    return $next($request);
  }
}


?>