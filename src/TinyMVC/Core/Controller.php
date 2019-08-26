<?php

namespace TinyMVC\Core;

use Throwable;
use TinyMVC\Core\Response;

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

  public function isActionExecutable() {
    $actionName = $this->request->getActionName();
    if (!method_exists($this, $actionName)) throw new Exception();
    return true;
  }

  public function executeAction() {
    $actionName = $this->request->getActionName();
    $params = $this->request->getParams();
    $this->preAction();
    $this->$actionName($params, $this->response);
    if (!$this->response->isSent()) $this->postAction($actionName);
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