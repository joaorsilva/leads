<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Login
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
class Login extends CI_Controller{

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        
        $this->load->view('login/index.php');
    }   
}
