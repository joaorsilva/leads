<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Spagi_FormHandler
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */

class Spagi_Session {
    
    protected $CI;
    
    public $language;
    
    public function __construct() {
        $this->CI = & get_instance();
        $this->language = $this->CI->session->userdata('language');
        $this->CI->spagi_i18n->set_language($this->language);
    }
    
    public function set($item,$value) {
        $this->$item = $value;
        $this->CI->session->set_userdata($item,$this->$item);
    }
    
    public function get($item) {
        return $this->CI->session->userdata($item);
    }
}
