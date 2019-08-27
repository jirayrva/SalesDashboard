<?php

namespace TinyMVC\Core;

use Throwable;
use TinyMVC\Core\Response;

abstract class Controller {

  protected $name;
  protected $request;
  protected $response;

  abstract protected function Index($params, $res);

  public function __construct($request, $response) {
    $this->request = $request;
    $this->response = $response;
  }
  
  public function init($actionName = "") {
    $this->name = (explode(CLASS_SEPARATOR, get_class($this)))[1];
    if ($this->name != $this->request->getControllerShortName()) {
      throw "Controller name does not match the one in Request";
    }
    $this->actionName = $actionName != "" ? $actionName : $this->request->getActionName();
    if (!method_exists($this, $this->actionName)) {
      throw new Exception();
    }
  }

  public function executeAction() {
    $params = $this->request->getParams();
    $actionName = $this->actionName;
    $this->preAction();
    $this->$actionName($params, $this->response);
    $this->postAction();
    if (!$this->response->isSent()) $this->renderView();
  }
  
  protected function renderView() {
    $viewName = VIEW_DIR . CLASS_SEPARATOR . $this->name . CLASS_SEPARATOR .  $this->actionName;
    $this->view = new $viewName($this, $this->actionName);
    $this->response->send($this->view->renderOutput());
  }

  protected function preAction() {
  }

  protected function postAction() {
  }

  protected function redirect() {
    // TODO:
  }

  public function getShortName() {
    return $this->name;
  }
}

?>