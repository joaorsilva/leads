<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Controllers
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
class Controllers extends CI_Controller {
    
    public $route = '/app/controllers/';
    public $menu = 'users';
    public $submenu = 'controllers';
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function index()
    {
        $this->spagi_i18n->load('controllers/index');
        $this->spagi_pagedata->route = $this->route;
        $this->spagi_pagedata->set_page_menu($this->menu, $this->submenu)
                            ->set_page(
                                     $this->spagi_i18n->_('__controllers__index Application Controllers'),
                                     $this->spagi_i18n->_('__controllers__index Application Controllers'),
                                     'Details list'
                                     )
                            ->addBreadcrumb(
                                     'Dashboard',
                                     '/dashboard',
                                     'fa fa-dashboard'
                                     )
                            ->addBreadcrumb(
                                     $this->spagi_i18n->_('__controllers__index Application Controllers'),
                                     '',
                                     'fa fa-th'
                                     )
                            ->addCss('/public/lte/plugins/daterangepicker/daterangepicker-bs3.css')
                            ->addJs('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js')
                            ->addJs('/public/lte/plugins/daterangepicker/daterangepicker.js')
                            ->addJs('/public/js/languages/english/date-options.js')
                            ->addJs('/public/js/form-list-common.js')
                            ->addJs('/public/js/app/controllers/index.js')
                            ->addCss('/public/css/form-list-common.css');
        
        $this->spagi_i18n->load('lists-common');
        
        $this->load->view('outframes/admin_header.php');
        $this->load->view('app/controllers/index.php');
        $this->load->view('outframes/admin_footer.php');
    }
    
    public function edit($id=0, $show = FALSE) 
    {
        //Loads the string translator library
        $this->spagi_i18n->load('controllers/edit');
        
        $icon = 'fa-edit';
        $subtitle = $this->spagi_i18n->_('__controllers__edit Edit Record');
        $text = $this->spagi_i18n->_('__controllers__edit Edit Controller');
        if($show) 
        {
            $icon = 'fa-television';
            $subtitle = $this->spagi_i18n->_('__controllers__edit Show Record');
            $text = $this->spagi_i18n->_('__controllers__edit Show Controller');
        }
        
        if($id === 'new') 
        {
            $icon = 'fa-file-text-o';
            $subtitle = $this->spagi_i18n->_('__controllers__edit New Record');
            $text = $this->spagi_i18n->_('__controllers__edit New Controller');
        }
                
        $this->spagi_pagedata->route = $this->route;
        $this->spagi_pagedata->set_page_menu($this->menu, $this->submenu)
                             ->set_page(
                                     $this->spagi_i18n->_('__controllers__edit Application Controller'),
                                     $this->spagi_i18n->_('__controllers__edit Application Controller'),
                                     $subtitle,
                                     $show
                                     )
                             ->addBreadcrumb(
                                     'Dashboard',
                                     '/dashboard',
                                     'fa fa-dashboard'
                                     )
                             ->addBreadcrumb(
                                     $this->spagi_i18n->_('__controllers__edit Application Controllers'),
                                     '/app/controllers',
                                     'fa fa-th-large'
                                     )
                             ->addBreadcrumb(
                                     $text,
                                     '',
                                     'fa ' . $icon
                                     )
                             ->addJs('/public/js/form-edit-common.js')
                             ->addJs('/public/js/app/controllers/edit.js');
        
        if($id)
        {
            $this->spagi_pagedata->page['id'] = $id;
        }
        $this->load->view('outframes/admin_header.php');
        $this->load->view('app/controllers/edit.php');
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
        $this->load->library('Spagi_FormHandler');
        $this->load->model('App_controllers_model');
        $this->spagi_formhandler->request_type = 'form';
        $this->spagi_formhandler->receive(__METHOD__);
        
        $res = array();
        if($id && is_numeric($id)) 
        {
            $res = $this->App_controllers_model->get($id);
        }
        
        $this->spagi_formhandler->rows = $res;
        $this->spagi_formhandler->send(__METHOD__);
    }
    
    public function select_list() 
    {
        $this->load->library('Spagi_FormHandler');
        $this->load->library('Spagi_Pagination');
        $this->load->model('App_controllers_model');
        $this->spagi_formhandler->request_type='list';
        $this->spagi_formhandler->receive(__METHOD__);

        $total_rows = $this->App_controllers_model->select_count_list(
                    $this->spagi_formhandler->filter
                );
        
        $this->spagi_formhandler->pagination['total_rows'] = $total_rows;
        
        $res = $this->App_controllers_model->select_list(
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
        $this->load->library('Spagi_FormHandler');
        $this->load->model('App_controllers_model');
        $this->spagi_formhandler->request_type = 'form';
        $this->spagi_formhandler->receive(__METHOD__);
        
        if(isset($this->spagi_formhandler->form["id"]) && is_numeric($this->spagi_formhandler->form["id"])) 
        {
            
            if($this->validate()) 
            {
                $this->spagi_formhandler->form['key'] = md5($this->spagi_formhandler->form['name']);
                $res = $this->App_controllers_model->update($this->spagi_formhandler->form);
            }
        } 
        else 
        {
            if($this->validate()) 
            {
                $this->spagi_formhandler->form['key'] = md5($this->spagi_formhandler->form['name']);
                $res = $this->App_controllers_model->insert($this->spagi_formhandler->form);
            }
        }
        
        //$this->spagi_formhandler->rows = $res;
        $this->spagi_formhandler->send(__METHOD__);
        
    }
    
    public function delete($id=0) 
    {
        $this->load->model('App_controllers_model');
        $this->output->set_content_type('application/json');
        
        if(!$id) 
        {
            $this->output->set_output(json_encode(array('result'=>'Error','message'=>$this->spagi_i18n->_('__controllers__edit No record to delete'))));            
        }
        
        if(is_array($id)) {
            $ids = $id;
        } else {
            $ids = array($id);
        }
        
        foreach($ids as $id) {
            $row = $this->App_controllers_model->get($id);
            if($row) {
                $this->App_controllers_model->delete($row);
            }
        }
        $this->output->set_output(json_encode(array('result'=>'ok','message'=>'')));
    }
    
    private function validate() 
    {
        if(!trim($this->spagi_formhandler->form['name'])) 
        {
            $this->spagi_formhandler->addError('form-name',$this->spagi_i18n->_('__controllers__edit This field must not be empty'));
        }
        
        if(!is_numeric($this->spagi_formhandler->form['app_modules_id'])) {
            $this->spagi_formhandler->addError('form-app_modules_id',$this->spagi_i18n->_('__controllers__edit You must choose a module'));
        }
        
        if(count($this->spagi_formhandler->error)) 
        {
            return FALSE;
        }
        
        return TRUE;
    }    
}
