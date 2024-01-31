<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Session extends CI_Session {

    public $CI;

    public function __construct(array $params = array()) {
        $this->CI = & get_instance();
        if ($this->ignore_sessions())
            return;
        parent::__construct();
    }

    function ignore_sessions() {
        if ($this->CI->uri->segment(1) == "api" || $this->CI->uri->segment(1) == 'challenges_v2' ||
                ($this->CI->input->method(TRUE) == 'GET' && $this->CI->uri->segment(1) == 'carrier' && $this->CI->router->fetch_class() == 'authorization' && $this->CI->router->fetch_method() == 'login') ||
                ($this->CI->input->method(TRUE) == 'GET' && $this->CI->uri->segment(1) == 'admin' && $this->CI->router->fetch_class() == 'authorization' && $this->CI->router->fetch_method() == 'login'))
            return true;
        return false;
    }

}
