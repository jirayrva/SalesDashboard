<?php

namespace TinyMVC;

class Response {

  private $data = "";
  private $status = 200;
  private $sent = false;

  public function send($data) {
    if ($this->sent) return;
    $this->data = $data;
    print $data;
    $this->sent = true;
    // exit;
  }

  public function append($data) {
    if ($this->sent) return;
    $this->data .= $data;
    print $data;
  }

  public function status() {
    $this->status = $status;
  }

  public function error() {
    
  }

  public function isSent() {
    return $this->sent;
  }
}