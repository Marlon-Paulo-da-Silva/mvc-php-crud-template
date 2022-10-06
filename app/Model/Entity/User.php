<?php

namespace App\Model\Entity;

use App\Db\Database;

class User{
 public $id_client;
 public $client_name;
 public $username;
 public $passwrd;

 // Cadastrar a instancia atual no banco de dados
 public function create(){

  // insere a instancia no banco de dados
  $this->id_client = (new Database('authentication'))->insert([
    'client_name' => $this->client_name,
    'username' => $this->username,
    'email' => $this->email,
    'passwrd' => $this->passwrd
  ]);
 }

 // atualizar o usuário no banco
 public function update() {
  return (new Database('authentication'))->update('id_client = ' . $this->id_client,[
    'client_name' => $this->client_name,
    'username' => $this->username,
    'email' => $this->email,
    'passwrd' => $this->passwrd
  ]);
 }

 // excluir o usuário no banco
 public function exclude() {
  return (new Database('authentication'))->delete('id_client = ' . $this->id_client);
 }
 // Método responsável por retornar Depoimentos
 public static function getUsers($where = null, $order = null, $limit = null, $field = '*'){
   return (new Database('authentication'))->select($where, $order, $limit, $field);
 }

 // retorna uma instancia com base no ID
 public static function getUserById($id){

  return self::getUsers('id_client  =' . $id)->fetchObject(self::class);
 }
 
 public static function getUserByEmail($email){
   return self::getUsers('email = "'.$email.'"')->fetchObject(self::class);
 }



}