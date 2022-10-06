<?php

namespace App\Http\Middleware;

class Maintenance{

  // Metodo responsável por executar o Middleware
  public function handle($request, $next){
    // Verifica o status de manutenção do sistema
    if (getenv('MAINTENANCE') == 'true') {
      throw new \Exception("Maintenance page, please try again more later", 200);
      
    }

    // Executa o próximo nível do Middleware
    return $next($request);
  }
}