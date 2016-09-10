<?php
/**
 * Description of Index
 *
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 * @version 1.0
 * @package leads
 * @subpackage libraries
 * @copyright 2016 SPAGI Sistemas, ME
 */
class AppProfiler {
    
    public $profiler_directory = '';
    public $profiler_requests_directory = '';
    public $index_file = '';
    public $index_data = array();
    protected $CI;
    
    public function __construct() {
        $this->CI = &get_instance();
        
        $this->CI->load->library('profiler');
        $path = $this->CI->config->item('profiler_path');
        if($path) {
            $this->profiler_directory = $path . '/';
        } else {
            $this->profiler_directory = APPPATH . 'profiler/';
        }
        $this->profiler_requests_directory = $this->profiler_directory . 'requests/';
        $this->index_file = $this->profiler_directory . 'index_' . (new DateTime())->format('Ymd') . '.json';
    }
    
    public function get_request($id) {
        return $this->load_request($id);
    }
    
    public function get_requests($start=0,$end=10,$filters=array()) {
        $this->load_index();
        
        $html = "<thead>";
        $html .= "<tr>";
        $html .= "<th>Date/Time</th><th>Id</th><th>From IP</th><th>Method</th><th>Uri</th><th>Protocol</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        foreach($this->index_data as $row) {
            $html .= "<tr>";
            $html .= "<td>" . $row->time . "</td>";
            $html .= "<td><a href=\"/_profiler/index/index/" . $row->id . "\"> " . $row->id . "</a></td>";
            $html .= "<td>" . $row->ip . "</td>";
            $html .= "<td>" . $row->method . "</td>";
            $html .= "<td>" . $row->uri . "</td>";
            $html .= "<td>" . $row->protocol . "</td>";
            $html .= "</tr>";
        }
        $html .= "</tbody>";
        return $html;
    }
    
    public function save() {
        $html = $this->CI->profiler->run();
        $request_id = md5($_SERVER['REQUEST_TIME'] . $_SERVER['REQUEST_METHOD'] . rand(0, 1000)); 
        $time = localtime($_SERVER['REQUEST_TIME'],true);
        
        $this->save_request($request_id,$html);
        $this->load_index();
        
        $obj = new stdClass();
        $obj->id = $request_id;
        $obj->method = $_SERVER['REQUEST_METHOD'];
        $obj->time = ($time['tm_year'] + 1900) . '-' . str_pad(($time['tm_mon'] + 1),2,'0',STR_PAD_LEFT) . '-' . str_pad($time['tm_mday'],2,'0',STR_PAD_LEFT) . ' ' . str_pad($time['tm_hour'],2,'0',STR_PAD_LEFT) . ':' . str_pad($time['tm_min'],2,'0',STR_PAD_LEFT) . ':' . str_pad($time['tm_sec'],2,'0',STR_PAD_LEFT); 
        $obj->ip = $_SERVER['REMOTE_ADDR'];
        $obj->protocol = $_SERVER['SERVER_PROTOCOL'];
        $obj->uri = $_SERVER['REQUEST_URI'];
        $obj->response = apache_response_headers();
        $this->index_data[] = $obj;
        
        usort($this->index_data, function($a, $b) {
            return strcmp($b->time,$a->time);
        });
        $this->save_index();
    }
    
    private function save_index() {
        file_put_contents($this->index_file,json_encode($this->index_data));
    }
    
    private function load_index() {
        if(!file_exists($this->index_file)) {
            $this->index_data = array();
            $this->save_index();
        }
        $json = file_get_contents($this->index_file);
        if($json) {
            $this->index_data = json_decode($json);
        }
    }
    
    private function save_request($id,$html) {
        file_put_contents($this->profiler_requests_directory . 'req_' . $id . '.html',$html);
    }
    
    private function load_request($id) {
        return file_get_contents($this->profiler_requests_directory . 'req_' . $id . '.html');
    }
    
    
    
}
