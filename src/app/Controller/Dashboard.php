<?php

namespace Controller;

class Dashboard extends \TinyMVC\Core\Controller{

  public function Index($params, $res) {
  }
  
  public function RangeData($params, $res) {
    if (!defined("APP_DASHBOARD_DEFAULT_DURATION")) define("APP_DASHBOARD_DEFAULT_DURATION", 30);
    $defaultDuration = sprintf('-%u days', APP_DASHBOARD_DEFAULT_DURATION);
    // TODO: all the param handling functionality should be moved to request
    $from = isset($params[0]) && $params[0] != "" ? $params[0] : date('Y-m-d', strtotime($defaultDuration));
    $to = isset($params[1]) && $params[1] != "" ? $params[1] : date("Y-m-d");
    $sales = new \Model\SalesRangeModel($from, $to);
    $data =  $sales->getRangeData();
    $res->send(json_encode($data));
  }
}

?>