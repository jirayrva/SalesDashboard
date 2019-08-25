<?php

namespace Model;

class SalesRangeModel extends \TinyMVC\Model {

  protected $from;
  protected $to;

  public function __construct($from, $to) {
    parent::__construct();
    $this->from = $from;
    $this->to = $to;
    // $this->baseQuerySQL = "SELECT %s FROM `order` LEFT JOIN `order_item` on `order`.oid = `order_item`.oid";
    $this->baseQuerySQL = "SELECT %s from (SELECT cid, `order`.oid, purchase_date, quantity, price,  quantity * price AS value FROM `order`, `order_item` WHERE `order`.oid = `order_item`.oid) AS base %s";
    // $this->baseQuerySQL = "SELECT %s FROM `order`, `order_item` where `order`.oid = `order_item`.oid";
    // SELECT cid, `order`.oid, purchase_date, quantity, price,  quantity * price as value FROM `order`, `order_item` where `order`.oid = `order_item`.oid
    // $this->baseQuerySQL = "SELECT * FROM `order`";
    
    // // base
    // from (SELECT cid, `order`.oid, purchase_date, quantity, price,  quantity * price as value FROM `order`, `order_item` where `order`.oid = `order_item`.oid) as base
    // // 1
    // SELECT distinct oid
    // // 2
    // SELECT sum(value) as revenue
    // //3
    // SELECT distinct cid
    // //4
    // SELECT purchase_date, sum(value) as revenue
    // group by purchase_date
    // // 5
    // select purchase_date, count(distinct cid)
    // group by purchase_date
    

  }

  public function getNoOfOrders() {
    $stmt = $this->queryFromBase("distinct oid");
    if (!$stmt || $stmt->rowCount() > 1)  die("error");
    while ($row = $stmt->fetch()) {
      return $row['oid'];
    }
  }

  public function getTotalRevenue($currency = "Sek") {
    $stmt = $this->queryFromBase("sum(value) as revenue");
    if (!$stmt || $stmt->rowCount() > 1)  die("error");
    while ($row = $stmt->fetch()) {
      return $row['revenue'];
    }
  }

  public function getNoOfCustomer() {
    $stmt = $this->queryFromBase("distinct cid");
    if (!$stmt || $stmt->rowCount() > 1)  die("error");
    while ($row = $stmt->fetch()) {
      return $row['cid'];
    }
  }

  public function getOrdersPerDay() {
    $stmt = $this->queryFromBase("purchase_date, sum(value) AS revenue", "group by purchase_date");
    if (!$stmt || $stmt->rowCount() > 1)  die("error");
    $result = array();
    while ($row = $stmt->fetch()) {
       $result[$row['purchase_date']]  = $row['revenue'];
    }
    return $result;
  }

  public function getCustomersPerDay() {
    $stmt = $this->queryFromBase("purchase_date, count(distinct cid) AS customers", "group by purchase_date");
    if (!$stmt || $stmt->rowCount() > 1)  die("error");
    $result = array();
    while ($row = $stmt->fetch()) {
       $result[$row['purchase_date']]  = $row['customers'];
    }
    return $result;
  }

}

?>