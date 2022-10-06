<?php

namespace App\Http;

class Response {
  private $httpCode = 200;

  private $headers = [];

  private $contentType = 'text/html';

  private $content;

  public function __construct($httpCode, $content, $contentType = 'text/html')
  {
    $this->httpCode = $httpCode;
    $this->content = $content;
    $this->setContentType($contentType);
  }

  public function addHeader($key, $value){
    $this->headers[$key] = $value;
  }

  private function sendHeaders(){
    http_response_code($this->httpCode);

    //ENVIAR HEADERS
    foreach ($this->headers as $key => $value) {
      header($key.': '.$value);
    }
  }

  /**
   * Get the value of contentType
   */ 
  public function getContentType()
  {
    return $this->contentType;
  }

  /**
   * Set the value of contentType
   *
   * @return  self
   */ 
  public function setContentType($contentType)
  {
    $this->contentType = $contentType;
    $this->addHeader('Content-Type',$contentType);

    return $this;
  }

  public function sendResponse(){
    $this->sendHeaders();
    
    switch ($this->contentType) {
      case 'text/html':
        echo $this->content;
        exit;

    }
  }

}