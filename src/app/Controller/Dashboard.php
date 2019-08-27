<?php

namespace Controller;

class Dashboard extends \TinyMVC\Core\Controller{

  public function Index($params, $res) {
    
    // $m = new HomeModel();
    // $this->processView("<h1>Hello to TinyMVC</h1><h2>Home</h2>");
    // $res->send("JVA");
    // $res->send($this->RangeData($params, $res));
  }
  
  public function RangeData($params, $res) {
    if (!defined("APP_DASHBOARD_DEFAULT_DURATION")) define("APP_DASHBOARD_DEFAULT_DURATION", 30);
    $defaultDuration = sprintf('-%u days', APP_DASHBOARD_DEFAULT_DURATION);
    // TODO: all the param handling functionality should be moved to request
    $from = isset($params[0]) && $params[0] != "" ? $params[0] : date('Y-m-d', strtotime($defaultDuration));
    $to = isset($params[1]) && $params[1] != "" ? $params[1] : date("Y-m-d");

//     print "from: " . $from . ", to: ". $to;
//     // print "[1]: " . $params[0] . ", 2: ". $params[1];
// var_dump($params);

    
    $sales = new \Model\SalesRangeModel($from, $to);
    $data =  $sales->getRangeData();
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