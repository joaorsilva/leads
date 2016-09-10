<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of ValidateUser
 *
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 * @version 1.0
 * @package leads
 * @subpackage hooks
 * @copyright 2016 SPAGI Sistemas, ME
 */

class ValidateUser {
    
    protected $ci;
    protected $allowedRoutes = array(
        array('api/'=>array('index'=>array('index'=>true))),
        array('api/'=>array('index'=>array('login'=>true))),
    );
    public function __construct() {
        $this->ci = &get_instance();
    }
    
    public function validate() {
        /*if(!$this->ci->router->directory) {
            return;
        }
        
        if($this->ci->config->item('profiler_enabled') === TRUE) {
            if($this->ci->router->directory === '_profiler/') {
                return;   
            }
        }
        
        foreach($this->allowedRoutes as $route) {
            if(isset($route[$this->ci->router->directory][$this->ci->router->class][$this->ci->router->method])) {
                return;
            }
        }
        if(!$this->ci->session->has_userdata('user')) {
            $this->ci->jsonresponse->respond(array('result'=>'error','message'=>'Not authorized.'),403);
        }
        $this->ci->session->user->last_operation = (new \DateTime)->format('Y-m-d H:i:s');
        $this->ci->session->user->update();*/
    }
}
