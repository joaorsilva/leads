<?php
/**
 * Description of Spagi_Language
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
class Spagi_Language {
    
    protected $locales = array(
        'en-US' => 'us-english',
        'en-UK' => 'uk-english',
        'en-IR' => 'ir-english',
        'en-AU' => 'au-english',
        'pt-BR' => 'brazillian-portuguese',
        'pt-PT' => 'portuguese',
    );
    
    protected $CI;
    
    public function __construct() {
        $this->CI =  & get_instance();
    }
    
    public function init_language($files = array()) {
        $defualt_files = array('common','errors');
        $language = $this->CI->session->get_userdata('language');
        if(!$language || !isset($this->locales[$language])) {
            $language = 'en-US';
        }
        $files = array_merge($defualt_files,$files);
        $this->lang->load($files,$this->locales[$language]);
    }
    
    public function number_format($number,$decimals=0) {
        
    }
    
    public function date_format($number) {
        
    }
    
    public function currentcy_format($number,$decimals=0) {
        
    }
}
