<?php

namespace TinyMVC;

class Response {

  private $data = "";
  private $statusCode = 200;
  private $sent = false;

  public function send($data) {
    if ($this->isSent()) return; // TODO: should throw an exception?
    $this->data = $data;
    $this->generateResponse();
    // exit;
    // TODO: avoid inifinite loop in case of an exception within send, even within send404
  }
  
  private function generateResponse() {
    http_response_code($this->statusCode);
    print $this->data;
    $this->sent = true;
  }

  public function append($data) {
    if ($this->isSent()) return;
    $this->data .= $data;
  }

  public function setStatusCode($statusCode) {
    if ($this->isSent()) return;
    // TODO: Check if $statusCode is a valid HTTP code
    $this->statusCode = $statusCode;
  }

  // public function error() {
    
  // }

  public function isSent() {
    return $this->sent;
  }

  public function send404($request, $details = []) {
    if ($this->isSent()) return;
    $this->setStatusCode(404);
    // TODO: Use a helper function to generate $data from $request and $details
    // $details = array(
    //   "URI" => $request->getURI(),
    //   "message" => $e->getMessage(),
    //   "File" => $e->getFile(),
    //   "Line" => $e->getLine(),
    // );
    // if (DEBUG) {
      //   echo sprintf(
      //     '<h3>%s</h3><h4>%s</h4><h5>%s:%s:%s</h5>',
      //     $e->getCode(),
      //     $e->getMessage(),
      //     ,
      //     $e->getFile(),
      //     $e->getLine()
      //   );
      // } else {
      //   http_response_code(404);
      //   echo sprintf("<h1>Page not found</h1><div>Page <i>'%s'</li> is not found.</div>", $request->getURI());
      // }
    $this->send("Page not found");
  }

  public function send500($request, $details = []) {
    if ($this->isSent()) return;
    $this->setStatusCode(500);
    // TODO: Use a helper function to generate $data from $request and $details
    $this->send("Internal server error");

  }
}