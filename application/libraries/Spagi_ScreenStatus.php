<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Spagy_ScreenStatus
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
class Spagi_ScreenStatus {
    
    protected $CI;
    
    public function __construct() {
        $this->CI = & get_instance();
    }
    
    public function save($screen_name, $data) {
        $this->CI->session->set_userdata($screen_name,$data);
    }
    
    public function load($screen_name) {
        if($this->CI->session->has_userdata($screen_name)) {
            return $this->CI->session->userdata($screen_name);
        }
        return array(
            'pagination'=>array(
                $page=0,
                $page_size=10
            ),
            'sort'=>array(
                'id',
                'ASC'
            ),
            'filter'=>array(),
            'form'=>array()
        );
    }

    public function clear($screen_name) {
        $this->CI->session->unset_userdata($screen_name);
    }
    
    
}
