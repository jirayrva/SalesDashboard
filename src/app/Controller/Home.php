<?php

namespace Controller;

use Model\HomeModel;

class Home extends \TinyMVC\Controller{

  public function Index($params, $res) {
      $m = new HomeModel();
  }

  public function Add($params, $res) {
   
  }

  public function Exception($params, $res) {
    throw new \Exception();
  }
}

?>