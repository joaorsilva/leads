<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Spagi_FormHandler
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */

class Spagi_I18n {
    
    const DEFAULT_LANGUAGE = 'english';
    
    public $languages = array(
        'english-US' => 'en-US',
        'english' => 'en',
        'portuguese' => 'pt',
        'portuguese-BR' => 'pt-BR'
    );
    
    public $language_code = '';
    public $language = '';
    public $base_language_folder = '';
    public $language_folder = '';
    public $translations = array();
    protected $CI;
    
    public function __construct() {
        $this->CI = & get_instance();
        $this->base_language_folder = APPPATH . 'language/';
        $this->set_language($this->CI->config->item('language'));
    }
    
    public function set_language($laguage) {
        $this->language = $laguage;
        if(!isset($this->languages[$this->language])) 
        {
            $this->language = Spagi_I18n::DEFAULT_LANGUAGE;
        }
        $this->language_code = $this->languages[$this->language];
        $this->language_folder = $this->base_language_folder . $this->language . '/';
        $this->load('base');
    }
    
    public function load($path) {
        $file = $this->language_folder . $path . '.json';
        if(file_exists($file)) {
            $content = file_get_contents($file);
            $json = json_decode($content, TRUE);
            if(!$json) {
                throw new Exception("SPAGI_I18N: File '" . $file . "' invalid or malformed!");
            }
            $this->translations = array_merge($this->translations, $json);
        } else {
            throw new Exception('SPAGI_I18N: File "' . $file . '" doesn\'t exist');
        }
    }
    
    public function _($text) {
        if(isset($this->translations[$text]))
        {
            return $this->translations[$text];
        }
        return $text;
    }
    
    public function get_date_format() {
        return $this->_('__global__ date_format');
    }
    
    public function get_time_format() {
        return $this->_('__global__ time_format');
    }
    
    public function get_date_time_format() {
        return $this->_('__global__ date_time_format');
    }
}
