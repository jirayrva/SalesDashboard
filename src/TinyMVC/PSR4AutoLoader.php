<?php 

namespace TinyMVC;

class PSR4AutoLoader {

  private $baseDir;

  public function __construct($baseDir){
    $this->baseDir = $baseDir;
  }

  public function register() {
    spl_autoload_register(function($classname) {
      require_once APP_PATH . str_replace(CLASS_SEPARATOR, DIRECTORY_SEPARATOR, $classname) . '.php';
    });
  }



}

?>