<?php

namespace TinyMVC\Core;

use \PDO;

class DB extends PDO {
// abstract class DB {

  public function __construct() {
    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;
    parent::__construct($dsn, DB_USER, DB_PASS);
    $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  }

}

?>