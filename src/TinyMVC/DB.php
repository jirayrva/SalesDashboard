<?php

namespace TinyMVC;

use \PDO;

class DB extends PDO {
// abstract class DB {

  public function __construct() {
    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;
    // echo $dsn;
    // $db = new \PDO($dsn, DB_USER, DB_PASS);
    parent::__construct($dsn, DB_USER, DB_PASS);
    $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $this->query("SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')");
  }

}

?>