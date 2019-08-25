<?php

namespace TinyMVC;

use Throwable;
use TinyMVC\Response;

abstract class Controller {

  protected $name;
  protected $request;
  protected $response;

  abstract protected function Index($params, $res);

  public function __construct($request) {
    $this->request = $request;
    $this->response = new Response();
    $this->init();
}

  protected function init() {
    $this->name = (explode(CLASS_SEPARATOR, get_class($this)))[1];
    if ($this->name != $this->request->getControllerShortName()) {
      throw "Controller name does not match the one in Request";
    }
  }

  public function executeAction() {
    $actionName = $this->request->getActionName();
    $params = $this->request->getParams();
    if (!method_exists($this, $actionName)) {
      echo "no";
      http_response_code(404);
      echo sprintf("<h1>Page not found</h1><div>Page <i>'%s'</li> is not found.</div>", $this->request->getURI());
    } else {
      try {
        $this->preAction();
        $this->$actionName($params, $this->response);
        if (!$this->response->isSent()) $this->postAction($actionName);
      } catch (Throwable $e) {
        if (DEBUG) {
          echo sprintf(
            '<h3>%s</h3><h4>%s</h4><h5>%s:%s:%s</h5>',
            $e->getCode(),
            $e->getMessage(),
            $this->request->getURI(),
            $e->getFile(),
            $e->getLine()
          );
        } else {
          http_response_code(500);
          echo sprintf("<h1>Internal application error</h1><div>Error while running page <i>'%s'</li>.</div>", $this->request->getURI());
        }
      }
    }
  }
  
  protected function postAction($actionName) {
    $viewName = "View" . CLASS_SEPARATOR . $this->name . CLASS_SEPARATOR .  $actionName;
    $this->view = new $viewName($this, $actionName);
    $this->response->send($this->view->renderOutput());
  }

  protected function preAction() {
  }

  protected function redirect() {
    // TODO:
  }

  public function getShortName() {
    return $this->name;
  }
}

?>