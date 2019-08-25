<?php 

namespace TinyMVC;

class PSR4AutoLoader {

  private $baseDir;

  public function __construct($baseDir){
    $this->baseDir = $baseDir;
  }

  public function register() {
    spl_autoload_register(function($classname) {
      $classFilename = APP_PATH . str_replace(CLASS_SEPARATOR, DIRECTORY_SEPARATOR, $classname) . '.php';
      // print $classFilename;
      if (file_exists($classFilename)) {
        require_once $classFilename;
      }
    });
  }



}

?>