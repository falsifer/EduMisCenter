<?php

class Onload {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
    }

    public function check_login() {
        $controller = $this->ci->router->class;
        $method = $this->ci->router->method;
        if ($this->ci->session->userdata("status") == NULL) {
            if ($controller == "Eschool" && $method == "index") {
                // eschool เป็น controller หลักและ index เป็น default method;
                //redirect('login');
            }
        }
    }

}
