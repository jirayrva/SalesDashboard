<?php 

namespace TinyMVC;

class PSR4AutoLoader {

  private $baseDir;
  private $frameworkDir;

  public function __construct($appDir, $frameworkDir = "TinyMVC") {
    $this->appDir = $appDir;
    $this->frameworkDir = $frameworkDir;
  }

  public function register() {
    spl_autoload_register(function($classname) {
      if ($this->isFrameworkClass($classname)) {
        $this->loadFrameworkClass($classname);
      } else {
        $this->loadAppClass($classname);
      }
    });
  }

  private function isFrameworkClass($classname) {
    $classnameParts = explode(CLASS_SEPARATOR, $classname);
    return ($classnameParts[0] == $this->frameworkDir);
  }

  private function loadFrameworkClass($classname) {
    $classnameParts = explode(CLASS_SEPARATOR, $classname);
    $frameworkClassnameParts = array_slice($classnameParts, 1);
    $frameworkClassname = implode(CLASS_SEPARATOR, $frameworkClassnameParts);
    // TODO: use REGEX instead
    $frameworkClassFilename = FRAMEWORK_PATH . str_replace(CLASS_SEPARATOR, DIRECTORY_SEPARATOR, $frameworkClassname) . '.php';
    $this->loadClass($frameworkClassFilename);
  }

  private function loadAppClass($classname) {
    $appClassFilename = APP_PATH . str_replace(CLASS_SEPARATOR, DIRECTORY_SEPARATOR, $classname) . '.php';
    $this->loadClass($appClassFilename);
  }

  private function loadClass($classFilename) {
    if (file_exists($classFilename)) {
      require_once $classFilename;
    }
  }
}

?>