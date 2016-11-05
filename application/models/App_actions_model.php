<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of App_actions_model
 *
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 * @version 1.0
 * @package leads
 * @subpackage models
 * @copyright 2016 SPAGI Sistemas, ME
 */
class App_actions_model extends Spagi_Model {
    
    protected $_table_name = "app_actions";

    /** 
     * @var integer|null Table app_action unique identifier. For new records this field should not be set. 
     */
    public $id;
    
    /** 
     * @var integer Table app_modules unique identifier. Must always be set.
     */
    public $app_modules_id;
    
    /** 
     * @var integer Table app_controllers unique identifier. Must always be set. 
     */
    public $app_controllers_id;
    
    /** 
     * @var string Action name must be unique. Must always be set. 
     */
    public $name;
    
    /** 
     * @var string Action md5 key must be unique. Must always be set. 
     */
    public $key;
    
    /** 
     * @var int Is the Action active. If the value is set to 0 the Action will not be active. Must always be set. 
     */
    public $active;
    public $created_by;
    public $created_date;
    public $updated_by;
    public $updated_date;
    public $deleted_by;
    public $deleted_date;
    public $deleted;
    
        public function __construct() 
    {
        parent::__construct();
    }
    
    public function get($id) {
        
        $this->db->select($this->_table_name.'.*, CONCAT(`user1`.first_name,\' \',`user1`.surename) as created_by, CONCAT(`user2`.first_name,\' \',`user2`.surename) as updated_by')
            ->from($this->_table_name)
            ->join('user_users as user1','user1.id = ' . $this->_table_name .'.created_by','LEFT')
            ->join('user_users as user2','user2.id = ' . $this->_table_name .'.updated_by','LEFT')
            ->where($this->_table_name . '.id = ',$id);
        
        $query = $this->db->get();
        $result = $query->result();
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
    
    public function select_list($paging,$filters=array(),$order=array('id','ASC')) 
    {
        $this->db->select($this->_table_name.'.*, modules1.name as app_module_name, controllers1.name as app_controller_name, CONCAT(`user1`.first_name,\' \',`user1`.surename) as created_by, CONCAT(`user2`.first_name,\' \',`user2`.surename) as updated_by')
            ->from($this->_table_name)
            ->join('user_users as user1','user1.id = ' . $this->_table_name .'.created_by','LEFT')
            ->join('user_users as user2','user2.id = ' . $this->_table_name .'.updated_by','LEFT')
            ->join('app_modules as modules1','modules1.id = ' . $this->_table_name .'.app_modules_id','INNER')    
            ->join('app_controllers as controllers1','controllers1.id = ' . $this->_table_name .'.app_controllers_id','INNER');    
        $this->list_where($filters);
        $this->list_sort($order);
        $this->db->limit($paging["page_size"], $paging["page"] * $paging["page_size"]);
        $query = $this->db->get();
        $result = $query->result();
        foreach($result as $row) {
            $row = $this->convertDates($row);
        }
        return $result;
    }
    
    public function select_count_list($filters=array()) 
    {
        $this->db->select('COUNT(*) as total')
            ->from($this->_table_name)
            ->join('user_users as user1','user1.id = ' . $this->_table_name .'.created_by','LEFT')
            ->join('user_users as user2','user2.id = ' . $this->_table_name .'.updated_by','LEFT');
        if($filters) 
        {
            $this->list_where($filters);
        }
        
        $query = $this->db->get();
        $res = $query->result();
        if(isset($res[0]->total)) {
            return $res[0]->total;
        }
        return 0;
    }
    
    public function select_controllers_filter($filter) {
        $this->db->select('id, name');
        $this->db->from($this->_table_name);
        $this->db->where('deleted = ', 0);
        if($filter) {
            $this->db->like('name',$filter,'both');
        }
        $query = $this->db->get();
        return $query->result();
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
        if(is_array($filters)) {
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
                    case 'app_modules_id':
                        $this->db->where($this->_table_name . '.app_modules_id',$value);
                        break;
                    case 'app_controllers_id':
                        $this->db->where($this->_table_name . '.app_controllers_id',$value);
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
