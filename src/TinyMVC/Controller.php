<?php

namespace TinyMVC;

use Throwable;

abstract class Controller {

  protected $request;
  protected $name;
  protected $view;
  protected $model;

  abstract protected function Index();

  public function __construct($request) {
    $this->request = $request;
    $this->init();
}

  protected function init() {
    $this->name = (explode(CLASS_SEPARATOR, get_class($this)))[1];
    if ($this->name != $this->request->getControllerShortName()) {
      throw "Controller name does not match the one in Request";
    }
    $viewName = "View" . CLASS_SEPARATOR . $this->name . "View";
    $modelName = "Model" . CLASS_SEPARATOR . $this->name . "Model";
    $this->view = new $viewName();
    $this->model = new $modelName();
  }
  
  protected function processView($view) {
    // print $view->output();
    print $view;
  }

  public function executeAction($actionName, $params) {
    if (!method_exists($this, $actionName)) {
      http_response_code(404);
      echo sprintf("<h1>Page not found</h1><div>Page <i>'%s'</li> is not found.</div>", $this->$request->getURI());
    } else {
      try {
        $this->$actionName($params);
      } catch (Throwable $e) {
        http_response_code(500);
        echo sprintf("<h1>Internal application error</h1><div>Error while running page <i>'%s'</li>.</div>", $request->getURI());
      }
    }
  }
}

?>