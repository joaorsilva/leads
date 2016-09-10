<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Users
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
class Users extends CI_Controller {

    public $route = '/app/controllers/';
    public $menu = 'users';
    public $submenu = 'controllers';
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function users_filter() 
    {    
        $filter = $this->input->get('q');
        
        $this->load->model('User_users_model');
        $res = $this->User_users_model->select_users_filter($filter);
        $rows = array();
        
        foreach($res as $row) 
        {
            $item['id'] = $row->id;
            $item['text'] = $row->name;
            $rows[] = $item;
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($rows));
    }
    
    
}
