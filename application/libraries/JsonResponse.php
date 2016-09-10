<?php
/**
 * Description of User_users_model
 *
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 * @version 1.0
 * @package leads
 * @subpackage libraries
 * @copyright 2016 SPAGI Sistemas, ME
 */
class JsonResponse extends CI_Output {
    
    private $CI;
    
    public function __construct() {
        parent::__construct();
        $this->CI = &get_instance();
    }
    
    public function respond($response=array(),$code=200) {
        $last_update = time();
        $this->set_status_header($code)
             ->set_content_type('application/json', 'utf-8')
             ->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $last_update).' GMT')
             ->set_header('Cache-Control: no-store, no-cache, must-revalidate')
             ->set_header('Cache-Control: post-check=0, pre-check=0')
             ->set_header('Pragma: no-cache')   
             ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
             ->_display();
    }
}
