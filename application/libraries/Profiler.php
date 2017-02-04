<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profiler
 *
 * @author joao
 */
define('PROFILER_ENABLED',TRUE);

if(ENVIRONMENT !== 'production' && defined('PROFILER_ENABLED') && PROFILER_ENABLED === TRUE) {
    require_once APPPATH. 'third_party/_profiler/core/bootstrap.php';
}

class Profiler 
{
    protected $CI;
    
    public function __construct() {
        $this->CI = & get_instance();
    }
    
}
