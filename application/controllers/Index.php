<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
class Index extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        //throw new Exception("Bosta");
        //$x=$a+1;
        $this->jsonresponse->respond(array('result'=>'ok','message'=>'a'),200);
        return;
        $this->load->model('App_modules_model');
        
        $this->App_modules_model->name = 'Modle 1';
        $this->App_modules_model->key = md5('Modle 1');
        $this->App_modules_model->active = 1;
        $this->App_modules_model->created_by = 1;
        $this->App_modules_model->updated_by = 1;
        $this->App_modules_model->insert();
        $this->App_modules_model->name = 'Modle 2';
        $this->App_modules_model->update();
        $this->App_modules_model->delete();
        
    }

    public function teste() {
        $this->jsonresponse->respond(array('result'=>'ok','message'=>''),200);
    }
}
