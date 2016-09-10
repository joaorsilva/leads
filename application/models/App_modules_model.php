<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of App_modules_model
 *
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 * @version 1.0
 * @package leads
 * @subpackage models
 * @copyright 2016 SPAGI Sistemas, ME
 */
class App_modules_model extends Spagi_Model {
    
    protected $_table_name = "app_modules";
    
    public $id;
    public $name;
    public $key;
    public $active;
    public $created_by;
    public $created_date;
    public $updated_by;
    public $updated_date;
    public $deleted_by;
    public $deleted_date;
    public $deleted;
    
    /**
     * __construct()
     * 
     * Constructs the App_modules_model object.
     * @return App_modules_model
     */
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function get($id) {
        $result = parent::get($id);
        foreach($result as $row) {
            $row = $this->convertDates($row);
        }
        return $result;
    }
    
    public function get_record($id) {
        $result = parent::get_record($id);
        $result = $this->convertDates($result);
        return $result;
    }
    
    protected function convertDates($object){
        if($object) {
            $object->updated_date = $this->convert_date_time($object->updated_date);
            $object->created_date = $this->convert_date_time($object->created_date);
            $object->deleted_date = $this->convert_date_time($object->deleted_date);            
        }
        return $object;
    }
    
    protected function list_where($filters) 
    {
        foreach($filters as $key => $value) 
        {
            if(!$value)
                continue;
            
            switch($key) 
            {
                case 'id':
                    $this->db->where($this->_table_name . '.id = ',$value);
                    break;
                case 'name':
                    $this->db->like($this->_table_name . '.name',$value,'both');
                    break;
                case 'created_by':
                    $this->db->where($this->_table_name . '.created_by',$value);
                    break;
                case 'created_date':
                    $dates = explode(' - ', $value);
                    if(count($dates) == 2) 
                    {
                        $this->db->where($this->_table_name . '.created_date >= ',$this->convert_date($dates[0],true) . ' 00:00:00');
                        $this->db->where($this->_table_name . '.created_date <= ',$this->convert_date($dates[1],true) . ' 23:59:59.99999');
                    }
                    break;
                case 'updated_by':
                    $this->db->where($this->_table_name . '.updated_by',$value);
                    break;
                case 'updated_date':
                    $dates = explode(' - ', $value);
                    if(count($dates) == 2) 
                    {
                        $this->db->where($this->_table_name . '.updated_date >= ',$this->convert_date($dates[0],true) . ' 00:00:00');
                        $this->db->where($this->_table_name . '.updated_date <= ',$this->convert_date($dates[1],true) . ' 00:00:00.99999');
                    }
                    break;
                case 'status':
                    if(is_array($value)) 
                    {
                        $this->db->group_start();
                        $str_where = '';
                        if(array_search('1', $value) !== FALSE)
                        {
                            $str_where .= '(' . $this->_table_name . '.active <> 0 AND ' . $this->_table_name . '.deleted = 0)';
                        }
                        if(array_search('2', $value) !== FALSE) 
                        {
                            if($str_where)
                                $str_where .= ' OR ';
                            $str_where .= '(' . $this->_table_name . '.active = 0 AND ' . $this->_table_name . '.deleted = 0)';
                        }
                        if(array_search('3', $value) !== FALSE) 
                        {
                            if($str_where)
                                $str_where .= ' OR ';
                            $str_where .= '(' . $this->_table_name . '.deleted <> 0)';
                        }
                        $this->db->where($str_where);
                        $this->db->group_end();
                    }
                    break;
            }
        }
        return $this->db;
    }
    
    protected function list_sort($order) 
    {
        if($order[0] == 'created_by') 
        {
            $this->db->order_by('`user1`.`first_name`',$order[1])
                    ->order_by('`user1`.`surename`',$order[1]);
        }
        else if($order[0] == 'updated_by') 
        { 
            $this->db->order_by('`user2`.`first_name`',$order[1])
                    ->order_by('`user2`.`surename`',$order[1]);
        } 
        else if($order[0] == 'status') 
        {
            if($order[1] == 'DESC') 
            {
                $this->db->order_by($this->_table_name.'.deleted','DESC');
                $this->db->order_by($this->_table_name.'.active','ASC');
            }
            else
            {
                $this->db->order_by($this->_table_name.'.deleted','ASC');
                $this->db->order_by($this->_table_name.'.active','DESC');
            }
        }
        else 
        {
            $this->db->order_by($this->_table_name.'.' . $order[0],$order[1]);
        }
        return $this->db;
    }
}
