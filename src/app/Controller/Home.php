<?php

namespace Controller;

use Model\HomeModel;

class Home extends \TinyMVC\Controller{

  // public function __construct($request) {
  //     parent::__construct($request);
  //     // $this->init();
  // }

  public function Index($params, $res) {
      $m = new HomeModel();
      // $this->processView("<h1>Hello to TinyMVC</h1><h2>Home</h2>");
      // $res.send("");
  }

  public function Add($params, $res) {
   
  }
}

?>