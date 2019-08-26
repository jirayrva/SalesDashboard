<?php 

namespace TinyMVC;

class PSR4AutoLoader {

  private $baseDir;

  public function __construct($baseDir){
    $this->baseDir = $baseDir;
  }

  public function register() {
    spl_autoload_register(function($classname) {
      $classnameParts = explode(CLASS_SEPARATOR, $classname);
      if ($classnameParts[0] == "TinyMVC") {
        $frameworkClassnameParts = array_slice($classnameParts, 1);
        $frameworkClassname = implode(CLASS_SEPARATOR, $frameworkClassnameParts);
        $classFilename = FRAMEWORK_PATH . str_replace(CLASS_SEPARATOR, DIRECTORY_SEPARATOR, $frameworkClassname) . '.php';
      } else {
        $classFilename = APP_PATH . str_replace(CLASS_SEPARATOR, DIRECTORY_SEPARATOR, $classname) . '.php';
      }
      if (file_exists($classFilename)) {
        require_once $classFilename;
      }
    });
  }



}

?>