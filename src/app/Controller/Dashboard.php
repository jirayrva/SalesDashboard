<?php

namespace Controller;

class Dashboard extends \TinyMVC\Controller{

  public function Index($params, $res) {
    
    
    // $m = new HomeModel();
    // $this->processView("<h1>Hello to TinyMVC</h1><h2>Home</h2>");
    // $res->send("JVA");
    $res->send($this->RangeData($params, $res));
  }
  
  public function RangeData($params, $res) {
    $from = isset($params[0]) ? $params[0] : 0;//getFrom();
    // $to = isset($params[1]) ? $params[1] : null;
    $to = isset($params[1]) ? $params[1] : 0;
    
    $sales = new \Model\SalesModel();
    $data =  array(
      'noOfOrders' => $sales->getNoOfOrders($from, $to),
      'totalRevenue' => $sales->getTotalRevenue($from, $to),
      'noOfCustomer' => $sales->getNoOfCustomer($from, $to),
      'customersPerDay' => $sales->getCustomersPerDay($from, $to),
      'ordersPerDay' => $sales->getOrdersPerDay($from, $to)
    );
    // $res->append(json_encode($data));
    $res->send(json_encode($data));
    // return json_encode($data);
    // return $this->stringifyDashboardData($data);
  }

  // private function stringifyDashboardData($data) {
  //   $result = array(
  //     'noOfOrders' => $data['noOfOrders'],
  //     'totalRevenue' => $data['totalRevenue'],
  //     'noOfCustomer' => $data['noOfCustomer'],
  //     'customersPerDay' => json_encode($data['customersPerDay']),
  //     'ordersPerDay' => json_encode($data['ordersPerDay'])
  //   );
  //   return json_encode($result); 
  // }
}

?>