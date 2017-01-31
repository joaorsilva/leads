<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Spagi_FormHandler
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */

class Spagi_FormHandler {
    
    protected $CI;
    public $pagination=array();
    public $filter=array();
    public $sort=array();
    public $rows=array();
    public $error=array();
    public $form=array();
    public $request_type='list';
    public $default_filter=true;
    
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('Spagi_ScreenStatus');
    }
    
    public function receive($method) {
        $this->default_filter = $this->CI->input->post('default-filter');
        $data = $this->CI->spagi_screenstatus->load($method);
        if($this->request_type === 'list') {
            $data = $this->receive_list($data);
        } else if($this->request_type === 'form') {
            $data = $this->receive_form($data);
        } else if ($this->request_type === 'delete') {
            $data = $this->receive_form($data);
        }
    }
    
    protected function receive_form($data) {
        //PUT verb support
        if($this->CI->input->method() === 'put' || $this->CI->input->method() === 'delete') {
            $putstream = fopen("php://input", "r");
            $content = '';
            $put_data = array();
            if($putstream) {
                while( $chunk = fread($putstream, 1024) ) {
                    $content .= $chunk;
                }
                fclose ($putstream);
                if($content) {
                    parse_str($content,$put_data);
                    if(isset($put_data['form'])) {
                        $this->form = $put_data['form'];
                    }
                }
            }
        } else {
            $this->form = $this->CI->input->post('form');
        }
    }
    
    protected function receive_list($data) {
        
        if(!$this->default_filter) {
            $sort_data = $this->CI->input->get('sort');
            $filter_data = $this->CI->input->get('filter');
            $pagination_data = $this->CI->input->get('pagination');
        } else {
            $sort_data = $data["sort"];
            $filter_data = $data["filter"];
            $pagination_data = $data["pagination"];
        }
        
        if(!isset($sort_data['field']) || !isset($sort_data['direction']) || !$sort_data['field'] || !$sort_data['direction']) {
            if(isset($data['sort'])) {
                $this->sort = $data['sort'];
            } else {
                $this->sort = NULL;
            }
        }  
        if(!$this->sort) {
            $this->sort = array();
            $this->sort[0] = str_replace('field-','',$sort_data['field']);
            $this->sort[1] = $sort_data['direction'];
        }
        
        $this->filter = $filter_data; 
        $this->pagination = $pagination_data;
        
        if( !isset($this->pagination['page']) || !isset($this->pagination['page_size'] ) || !$this->pagination['page_size'] ) {
            if(!isset($this->pagination['page']) || !$this->pagination['page']){
                $this->pagination['page'] = 0;
            }   
            if(!isset($this->pagination['page_size']) || !$this->pagination['page_size']) {
                $this->pagination['page_size'] = Spagi_Pagination::DEFAULT_PAGE_SIZE;
            }    
        }
    }

    public function send($method,$data=null,$code=200) {
        
        $data = "";
        
        if($this->request_type === 'list') {
            $data = array(
                'pagination'    => $this->pagination,
                'sort'          => $this->sort,
                'filter'        => $this->filter,
                'rows'          => $this->rows,
                'error'         => $this->error
            );
        } else if($this->request_type === 'form' || $this->request_type === 'delete') {
            $data = array(
                'rows'          => $this->rows,
                'error'         => $this->error
            );
        }
        $this->CI->spagi_screenstatus->save(
                $method,
                $data
            );

        $this->CI->output->set_content_type('application/json');
        $code = 200;
        if($this->request_type === 'list' && (!$data || !$data['rows']))
        {
            $code = 404;
        }
        $this->CI->output->set_status_header($code);
        $this->CI->output->set_output(json_encode($data));
    }
    
    public function clear($method) {
        $this->CI->spagi_screenstatus->clear($method);
        $this->error = array();
    }
    
    public function addError($field,$message) {
        $this->error[] = array('field'=>$field,'message'=>$message);
    }
}
