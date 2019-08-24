<?php

namespace Controller;

use TinyMVC\Controller;

class Home extends Controller{
    public function Index() {
        return "<h1>Hello to TinyMVC</h1><h2>Home</h2>";
    }
}

?>