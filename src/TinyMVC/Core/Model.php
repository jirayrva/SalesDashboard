<?php

namespace TinyMVC\Core;

class Model {

  protected $db;
  protected $baseQuerySQL;

  public function __construct() {
    $this->db = new DB();
  }

  // protected function queryFromBase($select = "*", $where = "", $group = "") {
  //   if (!isset($this->baseQuerySQL)) die("base sql not set");
  //   $sql = sprintf($this->baseQuerySQL, $select, $where, $group);
  //   var_dump($sql);
  //   return $this->db->query($sql);
  // }

}

?>