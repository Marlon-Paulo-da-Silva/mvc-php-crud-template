<?php

namespace App\Controller\Admin;
use App\Utils\View;


class Alert {
 /**
  * Metodo responsável por retornar uma mensagem de Erro
  * 
  * @param string message The message to be displayed
  * 
  * @return A string of HTML.
  */
  public static function getError($message){
    return View::render('admin/alert/status',[
      'contextual' => 'danger',
      'message' => $message
    ]);
  }

 /**
  * Metodo responsável por retornar uma mensagem de Successo
  * 
  * @param string message The message to be displayed
  * 
  * @return A string of HTML.
  */
  public static function getSuccess($message){
    return View::render('admin/alert/status',[
      'contextual' => 'success',
      'message' => $message
    ]);
  }
}