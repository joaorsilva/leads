<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Dashboard
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
class Dashboard extends CI_Controller{
    
    public $route = '/dashboard';
    public $menu = 'dashboard';
    public $submenu = '';

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->spagi_security->secure();
        $this->spagi_pagedata->route = $this->route;
        $this->spagi_pagedata->set_page_menu($this->menu, $this->submenu)
                             ->set_page(
                                     'Dashboard',
                                     'Dashboard',
                                     ''
                                     )
                             ->addBreadcrumb(
                                     'Dashboard',
                                     '',
                                     'fa fa-dashboard'
                                     )
                            ->addJs('/public/lte/dist/js/pages/dashboard.js');
        
        $this->load->view('outframes/admin_header.php');
        $this->load->view('app/dashboard/index.php');
        $this->load->view('outframes/admin_footer.php');
    }
}
