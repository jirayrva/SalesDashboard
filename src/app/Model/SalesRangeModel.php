<?php

namespace Model;

class SalesRangeModel extends \TinyMVC\Core\Model {

  protected $from;
  protected $to;

  public function __construct($from, $to) {
    parent::__construct();
    $this->from = $from;
    $this->to = $to;
    $this->baseQuerySQL = "SELECT %s
                           FROM (SELECT cid, `order`.oid, purchase_date, quantity, price,  quantity * price AS value
                                 FROM `order`, `order_item`
                                 WHERE `order`.oid = `order_item`.oid
                                ) AS base
                           WHERE purchase_date BETWEEN '%s' AND '%s'
                           %s";
  }

  protected function queryFromBase($select = "*", $group = "") {
    if (!isset($this->baseQuerySQL)) die("base sql not set");
    $sql = sprintf($this->baseQuerySQL, $select, $this->from, $this->to, $group);
    // var_dump($sql);
    return $this->db->query($sql);
  }

  public function getNoOfOrders() {
    $stmt = $this->queryFromBase("count(distinct oid) AS noOfOrders");
    if (!$stmt || $stmt->rowCount() > 1)  die("error1");
    while ($row = $stmt->fetch()) {
      return $row['noOfOrders'];
    }
  }

  public function getTotalRevenue($currency = "Sek") {
    $stmt = $this->queryFromBase("sum(value) AS revenue");
    if (!$stmt || $stmt->rowCount() > 1)  die("error2");
    while ($row = $stmt->fetch()) {
      return $row['revenue'];
    }
  }

  public function getNoOfCustomers() {
    $stmt = $this->queryFromBase("count(distinct cid) AS noOfCustomers");
    if (!$stmt || $stmt->rowCount() > 1)  die("error3");
    while ($row = $stmt->fetch()) {
      return $row['noOfCustomers'];
    }
  }

  public function getOrdersPerDay() {
    $stmt = $this->queryFromBase(
      "purchase_date, sum(value) AS revenue",
      "group by purchase_date");
    if (!$stmt)  die("error4");
    $result = array();
    while ($row = $stmt->fetch()) {
       $result[$row['purchase_date']]  = $row['revenue'];
    }
    return $result;
  }

  public function getCustomersPerDay() {
    $stmt = $this->queryFromBase(
      "purchase_date, count(distinct cid) AS customers",
      "group by purchase_date");
    if (!$stmt)  die("error5");
    $result = array();
    while ($row = $stmt->fetch()) {
       $result[$row['purchase_date']]  = $row['customers'];
    }
    return $result;
  }

  public function getRangeData() {
    $data = array(
      'datestamp' => date("Y-m-d H:i:s "),
      'rangeStartDate' => $this->from,
      'rangeEndDate' => $this->to,
      'noOfOrders' => $this->getNoOfOrders(),
      'totalRevenue' => round($this->getTotalRevenue(),2),
      'noOfCustomers' => $this->getNoOfCustomers(),
      'customersPerDay' => $this->getCustomersPerDay(),
      'ordersPerDay' => $this->getOrdersPerDay()
    );
    return $data;
  }

}

?>