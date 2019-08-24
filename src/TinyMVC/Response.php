<?php

namespace TinyMVC;

class Response {

  private $data = "";
  private $status = 200;

  public function send($data) {
    $this->data = $data;
    print $data;
  }

  public function append($data) {
    $this->data .= $data;
    print $data;
  }

  public function status() {
    $this->status = $status;
  }

  public function error() {
    
  }
}