<?php

namespace TinyMVC;

abstract class Controller {
  abstract protected function Index();
  
  protected function processView($view) {
    // print $view->output();
    print $view;
  }
}

?>