<?php

namespace TinyMVC\Core;

class Model {

  protected $db;
  protected $baseQuerySQL;

  public function __construct() {
    $this->db = new DB();
  }
}

?>