<?php

namespace TinyMVC\Core;

require "iView.php";

abstract class View implements iView {

  protected $viewName;
  protected $htmlFile;

  public function __construct($controller, $actionName) {
    $this->viewName = $controller->getShortName();
    $this->htmlFile = file_get_contents(APP_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $this->viewName . DIRECTORY_SEPARATOR . $actionName . ".html");
    // $body = file_get_contents($viewPath);
  }

  public function renderOutput() {
    return $this->htmlFile;
  }
}

?>