<?php
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
    
    public function index()
    {
        
    }

    public function index2()
    {
        $this->jsonresponse->respond(array('result'=>'ok','message'=>''),200);
    }
}
