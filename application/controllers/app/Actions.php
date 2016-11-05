<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Actions
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
class Actions extends CI_Controller {
    
    public $route = '/app/actions/';
    public $api_route = '/api/app/actions/';
    public $menu = 'users';
    public $submenu = 'actions';

    
    public function __construct() 
    {
        parent::__construct();
    }

    public function index()
    {
        $this->spagi_security->secure();
        $this->spagi_i18n->load('actions/index');
        $this->spagi_pagedata->route = $this->route;
        $this->spagi_pagedata->api_route = $this->api_route;
        $this->spagi_pagedata->set_page_menu($this->menu, $this->submenu)
                            ->set_page(
                                     $this->spagi_i18n->_('__actions__index Application Actions'),
                                     $this->spagi_i18n->_('__actions__index Application Actions'),
                                     'Details list'
                                     )
                            ->addBreadcrumb(
                                     'Dashboard',
                                     '/dashboard',
                                     'fa fa-dashboard'
                                     )
                            ->addBreadcrumb(
                                     $this->spagi_i18n->_('__actions__index Application Actions'),
                                     '',
                                     'fa fa-bolt'
                                     )
                            ->addCss('/public/lte/plugins/daterangepicker/daterangepicker-bs3.css')
                            ->addJs('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js')
                            ->addJs('/public/lte/plugins/daterangepicker/daterangepicker.js')
                            ->addJs('/public/js/languages/english/date-options.js')
                            ->addJs('/public/js/form-list-common.js')
                            ->addJs('/public/js/app/actions/index.js')
                            ->addCss('/public/css/form-list-common.css');
        
        $this->spagi_i18n->load('lists-common');
        
        $this->load->view('outframes/admin_header.php');
        $this->load->view('app/actions/index.php');
        $this->load->view('outframes/admin_footer.php');
    }
    
    public function edit($id=0, $show = FALSE) 
    {
        $this->spagi_security->secure();
        $this->spagi_pagedata->route = $this->route;
        $this->spagi_pagedata->api_route = $this->api_route;
        $icon = 'fa-edit';
        $subtitle = 'Edit Record';
        $text = 'Edit Action';
        if($show) 
        {
            $icon = 'fa-television';
            $subtitle = 'Show Record';
            $text = 'Show Action';
        }
        
        if($id === 'new') 
        {
            $icon = 'fa-file-text-o';
            $subtitle = 'New Record';
            $text = 'New Action';            
        }
                
        $this->spagi_pagedata->route = $this->route;
        $this->spagi_pagedata->set_page_menu($this->menu, $this->submenu)
                             ->set_page(
                                     'Application Action',
                                     'Application Action',
                                     $subtitle,
                                     $show
                                     )
                             ->addBreadcrumb(
                                     'Dashboard',
                                     '/dashboard',
                                     'fa fa-dashboard'
                                     )
                             ->addBreadcrumb(
                                     'Application Actions',
                                     '/app/actions',
                                     'fa fa-bolt'
                                     )
                             ->addBreadcrumb(
                                     $text,
                                     '',
                                     'fa ' . $icon
                                     )
                             ->addJs('/public/js/form-edit-common.js')
                             ->addJs('/public/js/app/actions/edit.js');
        
        if($id)
        {
            $this->spagi_pagedata->page['id'] = $id;
        }
        
        $this->spagi_i18n->load('forms-common');
        $this->spagi_i18n->load('actions/edit');
        
        $this->load->view('outframes/admin_header.php');
        $this->load->view('app/actions/edit.php');
        $this->load->view('outframes/admin_footer.php');        
               
    }
    
    public function show($id) 
    {
        $this->edit($id,TRUE);
    }
    
    public function create() 
    {
        $this->edit("new");
    }
    
    public function get($id) 
    {
        $this->spagi_security->secure(TRUE);
        $this->load->library('Spagi_FormHandler');
        $this->load->model('App_actions_model');
        $this->spagi_formhandler->request_type = 'form';
        $this->spagi_formhandler->receive(__METHOD__);
        
        $res = array();
        if($id && is_numeric($id)) 
        {
            $res = $this->App_actions_model->get($id);
        }
        
        $this->spagi_formhandler->rows = $res;
        $this->spagi_formhandler->send(__METHOD__);
    }
    
    public function select_list() 
    {
        $this->spagi_security->secure(TRUE);
        $this->load->library('Spagi_FormHandler');
        $this->load->library('Spagi_Pagination');
        $this->load->model('App_actions_model');
        $this->spagi_formhandler->request_type='list';
        $this->spagi_formhandler->receive(__METHOD__);

        $total_rows = $this->App_actions_model->select_count_list(
                    $this->spagi_formhandler->filter
                );
        
        $this->spagi_formhandler->pagination['total_rows'] = $total_rows;
        
        $res = $this->App_actions_model->select_list(
                    $this->spagi_formhandler->pagination,
                    $this->spagi_formhandler->filter,
                    $this->spagi_formhandler->sort
                );
        $pagination = $this->spagi_pagination->calculate(
                $this->spagi_formhandler->pagination['page'] * $this->spagi_formhandler->pagination['page_size'],
                $this->spagi_formhandler->pagination['page_size'],
                $this->spagi_formhandler->pagination['total_rows']
            );
        
        $this->spagi_formhandler->pagination = $pagination;
        $this->spagi_formhandler->rows = $res;
        $this->spagi_formhandler->send(__METHOD__);
        //$this->spagi_formhandler->clear(__METHOD__);
    }
    
    public function users_filter() 
    {
        $this->spagi_security->secure(TRUE);
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
    
    public function save() 
    {
        $this->spagi_security->secure(TRUE);
        $this->load->library('Spagi_FormHandler');
        $this->load->model('App_actions_model');
        $this->spagi_formhandler->request_type = 'form';
        $this->spagi_formhandler->receive(__METHOD__);
        
        if(isset($this->spagi_formhandler->form["id"]) && is_numeric($this->spagi_formhandler->form["id"])) 
        {
            
            if($this->validate()) 
            {
                $this->spagi_formhandler->form['key'] = md5($this->spagi_formhandler->form['name']);
                $res = $this->App_actions_model->update($this->spagi_formhandler->form);
            }
        } 
        else 
        {
            if($this->validate()) 
            {
                $this->spagi_formhandler->form['key'] = md5($this->spagi_formhandler->form['name']);
                $res = $this->App_actions_model->insert($this->spagi_formhandler->form);
            }
        }
        
        $this->spagi_formhandler->send(__METHOD__);
        
    }
    
    public function delete($id=0) 
    {
        $this->spagi_security->secure(TRUE);
        $this->load->model('App_actions_model');
        $this->output->set_content_type('application/json');
        
        if(!$id) 
        {
            $this->output->set_output(json_encode(array('result'=>'Error','message'=>$this->spagi_i18n->_('__actions__edit No record to delete'))));            
        }
        
        if(is_array($id)) {
            $ids = $id;
        } else {
            $ids = array($id);
        }
        
        foreach($ids as $id) {
            $row = $this->App_actions_model->get($id);
            if(isset($row[0])) {
                $this->App_actions_model->delete($row[0]);
            }
        }
        $this->output->set_output(json_encode(array('result'=>'ok','message'=>'')));
    }
    
    private function validate() 
    {
        if(!trim($this->spagi_formhandler->form['name'])) 
        {
            $this->spagi_formhandler->addError('form-name',$this->spagi_i18n->_('__actions__edit This field must not be empty'));
        }
        
        if(!is_numeric($this->spagi_formhandler->form['app_modules_id'])) {
            $this->spagi_formhandler->addError('form-app_modules_id',$this->spagi_i18n->_('__actions__edit You must choose a module'));
        }
        
        if(!is_numeric($this->spagi_formhandler->form['app_controllers_id'])) {
            $this->spagi_formhandler->addError('form-app_controllers_id',$this->spagi_i18n->_('__actions__edit You must choose a controller'));
        }

        if(count($this->spagi_formhandler->error)) 
        {
            return FALSE;
        }
        
        return TRUE;
    }    
}
