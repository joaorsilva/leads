<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Users
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
class Users extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        
        $data_frames = array(
            'menus' => array(
                'menu' => 'users',
                'submenu' => 'users'
            ),
            'page' => array(
                'title' => 'Users',
                'header' => 'Users',
                'subtitle' => 'Details list',
                'breadcrumb' => array(
                    array(
                        'text'=>'Dashboard',
                        'url'=>'/dashboard',
                        'icon' => 'fa fa-dashboard'
                    ),
                    array(
                        'text'=>'Users',
                        'url'=>'',
                        'icon' => 'fa fa-users'
                    )                    
                ),
                'css' => array(),
                'js' => array(
                    '/public/js/formcommon.js'
                )
            )            
        );

        $this->load->view('outframes/admin_header.php', $data_frames);
        //$this->load->view('users/users/index');
        $this->load->view('outframes/admin_footer.php');
    }
}
