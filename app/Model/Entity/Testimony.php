<?php

namespace App\Model\Entity;

use App\Db\Database;

class Testimony{
  public $id;
  public $name;
  public $message;
  public $date;

  // Metodo responsável por cadastrar a instancia atual no banco de dados
  public function cadastrar(){

    // define a data
    $this->date = date('Y-m-d H:i:s');
    
    // Insere o depoimento no banco de dados
    $this->id = (new Database('depoimentos'))->insert([
      'name' => $this->name,
      'message' => $this->message,
      'date' => $this->date
    ]);
    
    return true;
  }

  // Metodo responsável por atualizar os dados do banco de dados com a instancia atual
  public function atualizar(){
    
    // Atualiza o depoimento no banco de dados
    return (new Database('depoimentos'))->update('id = ' . $this->id,[
      'name' => $this->name,
      'message' => $this->message
    ]);
  }

  // Metodo responsável por excluir um depoimento do banco de dados com a instancia atual
  public function excluir(){
    
    // Exclui o depoimento no banco de dados
    return (new Database('depoimentos'))->delete('id = ' . $this->id);
  }

  // Método responsável por retornar Depoimentos
  public static function getTestimonies($where = null, $order = null, $limit = null, $field = '*'){
    
    return (new Database('depoimentos'))->select($where, $order, $limit, $field);
  }

  // retorna um depoimento com base em seu id
  public static function getTestimonyById($id){
    return self::getTestimonies('id = ' . $id)->fetchObject(self::class);
  }
}

?>