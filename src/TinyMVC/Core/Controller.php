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
// var_dump($params);
    $actionName = $this->actionName;
    $this->preAction();
    $this->$actionName($params, $this->response);
    $this->postAction();
    if (!$this->response->isSent()) $this->renderView();
  }
  
  protected function renderView() {
    $viewName = $this->getViewName();
    try {
      $view = new $viewName($this, $this->actionName);
    } catch (Throwable $e) {
      // Custom view php file does not exist, use default view php
      $view = new View($this, $this->actionName);
    } finally {
      try {
        $output = $view->renderOutput();
        $this->response->send($output);
      } catch (Throwable $e) {
        $this->response->send505($this->request, $e);
      }
    }
  }

  protected function getViewName() {
    return APP_VIEW_DIR . CLASS_SEPARATOR . $this->name . CLASS_SEPARATOR .  $this->actionName;
  }
  
  public function getShortName() {
    return $this->name;
  }

  protected function preAction() {
    // TODO:
  }

  protected function postAction() {
    // TODO:
  }

  protected function redirect() {
    // TODO:
  }
}

?>