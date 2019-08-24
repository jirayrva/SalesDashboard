<?php

namespace TinyMVC;

use Throwable;

abstract class Controller {
  abstract protected function Index();
  
  protected function processView($view) {
    // print $view->output();
    print $view;
  }

  public function executeAction($actionName, $params, $request) {
    if (!method_exists($this, $actionName)) {
      http_response_code(404);
      echo sprintf("<h1>Page not found</h1><div>Page <i>'%s'</li> is not found.</div>", $request->getURI());
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