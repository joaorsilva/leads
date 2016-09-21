<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Spagi_FormHandler
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */

class Spagi_PageData {
    
    public $route = '';
    public $api_route = '';
    public $page_menu = array();
    public $page = array();
    
    protected $CI;
    
    public function __construct() 
    {
        $this->CI = & get_instance();
    }
    
    public function set_page_menu($menu,$submenu) 
    {
        $this->page_menu = array(
            'menu'      => $menu,
            'submenu'   => $submenu
        );
        return $this;
    }
    
    public function set_page($title, $header, $subtitle, $show = FALSE, $id = 0) 
    {
        $this->page = array(
            'title'         => $title,
            'header'        => $header,
            'subtitle'      => $subtitle,
            'breadcrumb'    => array(),
            'css'           => array(),
            'js'            => array(),
            'id'            => $id,
            'show'          => $show
        );
        return $this;
    }
    
    public function addBreadcrumb($text, $url='', $icon='') 
    {
        if(!$this->page) 
        {
            throw new Exception('Spagi_PageData: set_page have not yet been called.');
        }
        $this->page['breadcrumb'][] = array(
            'text'          => $text,
            'url'           => $url,
            'icon'          => $icon
        );
        return $this;
    }
    
    public function addCss($url) 
    {
        if(!$this->page) 
        {
            throw new Exception('Spagi_PageData: set_page have not yet been called.');
        }
        $this->page['css'][] = $url;
        return $this;
    }
    
    public function addJs($url) 
    {
        if(!$this->page) 
        {
            throw new Exception('Spagi_PageData: set_page have not yet been called.');
        }
        $this->page['js'][] = $url;
        return $this;
    }
}
