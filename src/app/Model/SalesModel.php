<?php

namespace Model;

class SalesModel extends \TinyMVC\Core\Model {

  public function getNoOfOrders($from, $to) {
    return 100;
  }

  public function getTotalRevenue($from, $to, $currency = "Sek") {
    return 50;
  }

  public function getNoOfCustomers($from, $to) {
    return 5;
  }

  public function getCustomersPerDay($from, $to) {
    return array (
      '20190720' => 100,
      '20190721' => 200,
      '20190722' => 300,
      '20190723' => 400,
      '20190724' => 500,
      '20190725' => 600,
    );
  }

  public function getOrdersPerDay($from, $to) {
    return array (
      '20190720' => 2500,
      '20190721' => 3000,
      '20190722' => 1000,
      '20190723' => 4000,
      '20190724' => 5500,
      '20190725' => 600,
    );
  }

}

?>