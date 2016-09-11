<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Login
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
class Modules extends CI_Controller {

    public $route = '/app/modules/';
    public $menu = 'users';
    public $submenu = 'modules';
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        //$this->spagi_security->secure();
        
        $this->spagi_pagedata->route = $this->route;
        $this->spagi_pagedata->set_page_menu($this->menu, $this->submenu)
                            ->set_page(
                                     'Application Modules',
                                     'Application Modules',
                                     'Details list'
                                     )
                            ->addBreadcrumb(
                                     'Dashboard',
                                     '/dashboard',
                                     'fa fa-dashboard'
                                     )
                            ->addBreadcrumb(
                                     'Application Modules',
                                     '',
                                     'fa fa-th-large'
                                     )
                            ->addCss('/public/lte/plugins/daterangepicker/daterangepicker-bs3.css')
                            ->addJs('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js')
                            ->addJs('/public/lte/plugins/daterangepicker/daterangepicker.js')
                            ->addJs('/public/js/languages/english/date-options.js')
                            ->addJs('/public/js/form-list-common.js')
                            ->addJs('/public/js/app/modules/index.js')
                            ->addCss('/public/css/form-list-common.css');
        
        $this->spagi_i18n->load('lists-common');
        $this->spagi_i18n->load('modules/index');
        $this->load->view('outframes/admin_header.php');
        $this->load->view('app/modules/index.php');
        $this->load->view('outframes/admin_footer.php');
    }
    
    public function edit($id=0, $show = FALSE) 
    {
        $this->spagi_security->secure();
        $icon = 'fa-edit';
        $subtitle = 'Edit Record';
        $text = 'Edit Module';
        if($show) 
        {
            $icon = 'fa-television';
            $subtitle = 'Show Record';
            $text = 'Show Module';
        }
        
        if($id === 'new') 
        {
            $icon = 'fa-file-text-o';
            $subtitle = 'New Record';
            $text = 'New Module';            
        }
                
        $this->spagi_pagedata->route = $this->route;
        $this->spagi_pagedata->set_page_menu($this->menu, $this->submenu)
                             ->set_page(
                                     'Application Module',
                                     'Application Module',
                                     $subtitle,
                                     $show
                                     )
                             ->addBreadcrumb(
                                     'Dashboard',
                                     '/dashboard',
                                     'fa fa-dashboard'
                                     )
                             ->addBreadcrumb(
                                     'Application Modules',
                                     '/app/modules',
                                     'fa fa-th-large'
                                     )
                             ->addBreadcrumb(
                                     $text,
                                     '',
                                     'fa ' . $icon
                                     )
                             ->addJs('/public/js/form-edit-common.js')
                             ->addJs('/public/js/app/modules/edit.js');
        
        if($id)
        {
            $this->spagi_pagedata->page['id'] = $id;
        }
        $this->spagi_i18n->load('modules/edit');
        $this->load->view('outframes/admin_header.php');
        $this->load->view('app/modules/edit.php');
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
        $this->load->model('App_modules_model');
        $this->spagi_formhandler->request_type = 'form';
        $this->spagi_formhandler->receive(__METHOD__);
        
        $res = array();
        if($id && is_numeric($id)) 
        {
            $res = $this->App_modules_model->get($id);
        }
        
        $this->spagi_formhandler->rows = $res;
        $this->spagi_formhandler->send(__METHOD__);
    }
    
    public function select_list() 
    {
        //$this->spagi_security->secure(TRUE);
        $this->load->library('Spagi_FormHandler');
        $this->load->library('Spagi_Pagination');
        $this->load->model('App_modules_model');
        $this->spagi_formhandler->request_type='list';
        $this->spagi_formhandler->receive(__METHOD__);

        $total_rows = $this->App_modules_model->select_count_list(
                    $this->spagi_formhandler->filter
                );
        
        $this->spagi_formhandler->pagination['total_rows'] = $total_rows;
        
        $res = $this->App_modules_model->select_list(
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
    
    public function save() 
    {
        $this->spagi_security->secure(TRUE);
        $this->load->library('Spagi_FormHandler');
        $this->load->model('App_modules_model');
        $this->spagi_formhandler->request_type = 'form';
        $this->spagi_formhandler->receive(__METHOD__);
        
        if(isset($this->spagi_formhandler->form["id"]) && is_numeric($this->spagi_formhandler->form["id"])) 
        {
            
            if($this->validate()) 
            {
                $this->spagi_formhandler->form['key'] = md5($this->spagi_formhandler->form['name']);
                $res = $this->App_modules_model->update($this->spagi_formhandler->form);
            }
        } 
        else 
        {
            if($this->validate()) 
            {
                $this->spagi_formhandler->form['key'] = md5($this->spagi_formhandler->form['name']);
                $res = $this->App_modules_model->insert($this->spagi_formhandler->form);
            }
        }
        
        //$this->spagi_formhandler->rows = $res;
        $this->spagi_formhandler->send(__METHOD__);
        
    }
    
    public function delete($id=0) 
    {
        $this->spagi_security->secure(TRUE);
        $this->load->model('App_modules_model');
        $this->output->set_content_type('application/json');
        
        if(!$id) 
        {
            $this->output->set_output(json_encode(array('result'=>'Error','message'=>'No record to delete!')));            
        }
        
        if(is_array($id)) {
            $ids = $id;
        } else {
            $ids = array($id);
        }
        
        foreach($ids as $id) {
            $row = $this->App_modules_model->get($id);
            if($row) {
                $this->App_modules_model->delete($row);
            }
        }
        $this->output->set_output(json_encode(array('result'=>'ok','message'=>'')));
    }
    
    public function modules_filter() 
    {
        $this->spagi_security->secure(TRUE);
        $filter = $this->input->get('q');
        
        $this->load->model('App_modules_model');
        $res = $this->App_modules_model->select_modules_filter($filter);
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
    
    
    private function validate() 
    {
        if(!trim($this->spagi_formhandler->form['name'])) 
        {
            $this->spagi_formhandler->addError('form-name','This field must not be empty!');
        }
        
        if(count($this->spagi_formhandler->error)) 
        {
            return FALSE;
        }
        
        return TRUE;
    }
    
}
