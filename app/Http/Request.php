<?php

namespace App\Http;

class Request
{
    private $httpMethod;

    private $uri;

    private $router;

    private $queryParams = [];

    private $postVars = [];

    private $headers = [];

    public function __construct($router)
    {
        $this->router = $router;
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->setUri();
    }

     /**
     * Set the value of uri
     *
     * @return  self
     */
    public function setUri()
    {
        // URI completa (COM GETS)
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';

        // remove gets da URI
        $xURI = explode('?', $this->uri);

        $this->uri = $xURI[0];
    }

    

    /**
     * Get the value of router
     */ 
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * Get the value of httpMethod
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Set the value of httpMethod
     *
     * @return  self
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;

        return $this;
    }

    /**
     * Get the value of uri
     */
    public function getUri()
    {
        return $this->uri;
    }

   

    /**
     * Get the value of queryParams
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * Set the value of queryParams
     *
     * @return  self
     */
    public function setQueryParams($queryParams)
    {
        $this->queryParams = $queryParams;

        return $this;
    }

    /**
     * Get the value of postVars
     */
    public function getPostVars()
    {
        return $this->postVars;
    }

    /**
     * Set the value of postVars
     *
     * @return  self
     */
    public function setPostVars($postVars)
    {
        $this->postVars = $postVars;

        return $this;
    }

    /**
     * Get the value of headers
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set the value of headers
     *
     * @return  self
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    
}
