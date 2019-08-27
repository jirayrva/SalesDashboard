<?php 

namespace TinyMVC;

use Throwable;

require_once("PSR4AutoLoader.php");

use \TinyMVC\Core\Request;
use \TinyMVC\Core\Response;

class Bootstrap {

  public static function run() {
    self::init();
    $loader = new PSR4AutoLoader(APP_PATH);
    $request = new Request($_SERVER, $_POST, $_GET, $_FILES);
    $response = new Response();
    self::route($request, $response);
  }
  
  private static function init() {
    // User configurable constants 
    if (!defined("APP_SOURCE_FOLDER_NAME")) define("APP_SOURCE_FOLDER_NAME", "app");
    if (!defined("APP_CONTROLLER_DIR")) define("APP_CONTROLLER_SUFFIX", "Controller");
    if (!defined("APP_VIEW_DIR")) define("APP_VIEW_DIR", "View");
    if (!defined("APP_MODEL_DIR")) define("APP_MODEL_DIR", "Model");
    if (!defined("APP_DEFAULT_CONTROLLER")) define("APP_DEFAULT_CONTROLLER", "Home");
    if (!defined("APP_DEFAULT_ACTION")) define("APP_DEFAULT_ACTION", "Index");
    if (!defined("DEBUG")) define("DEBUG", false);
    
    // Framework constants
    define("CLASS_SEPARATOR", "\\");
    define("ROOT", getcwd() . DIRECTORY_SEPARATOR);
    define("FRAMEWORK_PATH", ROOT . "TinyMVC" . DIRECTORY_SEPARATOR);
    define("APP_PATH", ROOT . APP_SOURCE_FOLDER_NAME . DIRECTORY_SEPARATOR);

    // set_exception_handler();
  }

  private static function route($request, $response) {
    $controllerClassName = $request->getControllerName();
    // TODO: refactor to use one catch
    try {
      $controller = new $controllerClassName($request, $response);
      try {
        $controller->init();
        try {
          $controller->executeAction();
        } catch (Throwable $e) {
          // throw $e;
          if (DEBUG) throw $e;
          else $response->send500($request, $e);
        }
      } catch (Throwable $e) {
        if (DEBUG) throw $e;
        else $response->send404($request, $e);
      }
    } catch (Throwable $e) {
      if (DEBUG) throw $e;
      else $response->send404($request, $e);
    }
  }
}

?>