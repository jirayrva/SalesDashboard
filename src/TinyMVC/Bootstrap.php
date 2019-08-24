<?php 

namespace TinyMVC;

require_once("PSR4AutoLoader.php");

class Bootstrap {

  public static function run() {
    self::init();
    require_once(FRAMEWORK_PATH . "Controller.php");
    require_once(FRAMEWORK_PATH . "Request.php");
    
    $loader = new PSR4AutoLoader(APP_PATH);
    $loader->register();
    $request = new Request($_SERVER, $_POST, $_GET, $_FILES);
    self::route($request);
  }
  
  private static function init() {
    define("ROOT", getcwd() . DIRECTORY_SEPARATOR);
    define("FRAMEWORK_PATH", ROOT . "TinyMVC" . DIRECTORY_SEPARATOR);
    define("APP_PATH", ROOT . 'app' . DIRECTORY_SEPARATOR);
    define("CONTROLLER_SUFFIX", "Controller");
    define("CLASS_SEPARATOR", "\\");
    define("DEFAULT_CONTROLLER", "Home");
    define("DEFAULT_ACTION", "Index");
  }

  private static function route($request) {
    $controllerClassName = $request->getControllerName();
    $actionName = $request->getActionName();
    $params = $request->getParams();
    $controller = new $controllerClassName;
    $controller->$actionName($params);
  }

}

?>