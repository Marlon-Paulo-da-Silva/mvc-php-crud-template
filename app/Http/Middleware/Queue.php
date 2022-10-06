<?php

namespace App\Http\Middleware;

class Queue {

  // Mapeamento de Middlewares
  private static $map = [];

  // Mapeamento de Middlewares padrões de todas as rotas
  private static $default = [];

  // fila de Middlewares à serem executados
  private $middlewares = [];

  // Função de execução do controlador (Closure)
  private $controller;

  // argumentos da função do controlador
  private $controllerArgs = [];

  // Metodo responsável por contruir a classe de fila de Middleware
  public function __construct($middlewares, $controller, $controllerArgs)
  {
    $this->middlewares = array_merge(self::$default, $middlewares);
    $this->controller = $controller;
    $this->controllerArgs = $controllerArgs;
  }

  // Metodo responsável por definir o mapeamento de Middleware
  public static function setMap($map){
    self::$map = $map;
  }

  // Metodo responsável por definir o mapeamento de Middleware padrões
  public static function setDefault($default){
    self::$default = $default;
  }

  // Metodo responsável por executar o próximo nível da fila de middleware
  public function next($request){
    
  //  verifica se a fila está vazia
   if(empty($this->middlewares)){

      return call_user_func_array($this->controller, $this->controllerArgs);
    }
    
    // TODO 25:20

    // Middleware
    $middlewares = array_shift($this->middlewares);
    
    // Verifica o Mapeamento
    if(!isset(self::$map[$middlewares])){
      throw new \Exception("Middleware request not processing", 500);
      
    }

    // Next
    $queue = $this;
    $next = function($request) use($queue){
      return $queue->next($request);
    };

    // Executa o Middleware
    return (new self::$map[$middlewares])->handle($request, $next);
    
    

  }


  
}