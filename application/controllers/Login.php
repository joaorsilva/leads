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
        $this->spagi_i18n->load('login');
        $this->spagi_pagedata->set_page(
                $this->spagi_i18n->_('__login__ Login'),
                $this->spagi_i18n->_('__login__ Login'),
                $this->spagi_i18n->_('__login__ Login')
                )
            ->addJs('/public/js/login/index.js');

        $this->load->view('login/index.php');
    }
    
    public function login() {
        $this->load->library("Spagi_Security");
        $this->spagi_security->login();
    }
}
