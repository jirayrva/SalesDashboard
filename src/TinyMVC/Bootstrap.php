<?php 

namespace TinyMVC;

use Throwable;

require_once("PSR4AutoLoader.php");

class Bootstrap {

  public static function run() {
    self::init();
    $loader = new PSR4AutoLoader(APP_PATH);
    $loader->register();
    $request = new Request($_SERVER, $_POST, $_GET, $_FILES);
    $response = new Response();
    self::route($request, $response);
  }
  
  private static function init() {
    // User configurable constants 
    if (!defined("APP_SOURCE_FOLDER_NAME")) define("APP_SOURCE_FOLDER_NAME", "app");
    if (!defined("APP_CONTROLLER_SUFFIX")) define("APP_CONTROLLER_SUFFIX", "Controller");
    if (!defined("APP_DEFAULT_CONTROLLER")) define("APP_DEFAULT_CONTROLLER", "Home");
    if (!defined("APP_DEFAULT_ACTION")) define("APP_DEFAULT_ACTION", "Index");
    if (!defined("DEBUG")) define("DEBUG", true);
    
    // Framework constants
    define("CLASS_SEPARATOR", "\\");
    define("ROOT", getcwd() . DIRECTORY_SEPARATOR);
    define("FRAMEWORK_PATH", ROOT . "TinyMVC" . DIRECTORY_SEPARATOR);
    define("APP_PATH", ROOT . APP_SOURCE_FOLDER_NAME . DIRECTORY_SEPARATOR);

    // Require framework specific files
    require_once(FRAMEWORK_PATH . "Request.php");
    require_once(FRAMEWORK_PATH . "Response.php");
    require_once(FRAMEWORK_PATH . "Controller.php");
    require_once(FRAMEWORK_PATH . "DB.php");
    require_once(FRAMEWORK_PATH . "Model.php");
    require_once(FRAMEWORK_PATH . "View.php");

    // set_exception_handler();
  }

  private static function route($request, $response) {
    $controllerClassName = $request->getControllerName();
    try {
      $controller = new $controllerClassName($request);
      $controller->isActionExecutable();
    } catch (Throwable $e) {
      $response->send404($request, $e);
    }
    try {
      $controller->executeAction();
    } catch (Throwable $e) {
      $response->send500($request, $e);
    }
  }

}

?>