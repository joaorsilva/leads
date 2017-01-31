<?php
/**
 * Description of Index
 *
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 * @version 1.0
 * @package leads
 * @subpackage controllers
 * @copyright 2016 SPAGI Sistemas, ME
 */
class Index extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $request = $this->input->get('request');
        if(!$request) {
            $data['data']=array();
            $res = ProfilerLibrary::get_requests();
            if($res['result'] === 'ok') {
                $data['data']=$res['message'];
            }
            $this->load->view('_profiler/index',$data);
        } else {
            $data['data'] = ProfilerLibrary::get_request($request);
            $this->load->view('_profiler/request',$data);
        }    
    }
    
}
