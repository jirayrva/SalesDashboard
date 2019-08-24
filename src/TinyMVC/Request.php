<?php

namespace TinyMVC;

class Request{

    private $server;
    private $post;
    private $get;
    private $files;
    private $controllerName;
    private $actionName;
    private $params; 

    public function __construct(
      array $server = [],
      array $post = [],
      array $get = [],
      array $files = []
  ) {
      $this->server = $server;
      $this->post = $post;
      $this->get = $get;
      $this->files = $files;
      $this->init();

  }

  private function init() {
    $path= $_SERVER['REQUEST_URI'];
    $parts = explode(DIRECTORY_SEPARATOR, ltrim($path));
    // TODO: Investigate how to check null/non-existence in PHP
    $this->controllerName = isset($parts[1]) && $parts[1] != "" ? ucfirst($parts[1]) : "Home";
    $this->actionName = isset($parts[2]) && $parts[2] != "" ? $parts[2] : "Index";
    $this->params = array_slice($parts, 3); 
  }

  public function getControllerName() {
    return CONTROLLER_SUFFIX . "\\" . $this->controllerName;
  }

  public function getActionName() {
    return $this->actionName;
  }

  public function getParams() {
    return $this->params;
  }
}

?>