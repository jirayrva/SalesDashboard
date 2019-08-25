<?php

namespace TinyMVC;

class Model {

  protected $db;
  protected $baseQuerySQL;

  public function __construct() {
    $this->db = new DB();
  }

  protected function queryFromBase($select = "*", $group = "") {
    if (!isset($this->baseQuerySQL)) die("base sql not set");
    $sql = sprintf($this->baseQuerySQL, $select, $group);
    // var_dump($sql);
    return $this->db->query($sql);
  }

}

?>