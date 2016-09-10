<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once SYSDIR . "/core/Model.php";
/**
 * Description of Spagi_Model
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
class Spagi_Model extends CI_Model {

    const DB_DATETIME_FORMAT = 'Y-m-d H:i:s';
    const DB_DATE_FORMAT = 'Y-m-d';
    const DB_TIME_FORMAT = 'H:i:s';
    
    protected $_table_name;
    protected $_date_format = 'Y-m-d';
    protected $_time_format = 'H:i:s';
    protected $_date_time_format = 'Y-m-d H:i:s';
    protected $_CI;
    protected $_is_init = false;
    
    public function __construct() 
    {
        parent::__construct();
        $this->_CI = &get_instance();
        $this->_date_format = $this->_CI->spagi_i18n->get_date_format();
        $this->_time_format = $this->_CI->spagi_i18n->get_time_format();
        $this->_date_time_format = $this->_CI->spagi_i18n->get_date_time_format();        
    }
    
    public function get($id) 
    {
        $this->db->select($this->_table_name.'.*, CONCAT(`user1`.first_name,\' \',`user1`.surename) as created_by, CONCAT(`user2`.first_name,\' \',`user2`.surename) as updated_by')
            ->from($this->_table_name)
            ->join('user_users as user1','user1.id = ' . $this->_table_name .'.created_by','LEFT')
            ->join('user_users as user2','user2.id = ' . $this->_table_name .'.updated_by','LEFT')
            ->where($this->_table_name . '.id = ',$id);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function get_record($id)
    {
        $this->db->select('*')
             ->from($this->_table_name)
             ->where($this->_table_name . '.id = ',$id);
        $query = $this->db->get();
        $res = $query->result();
        if($res)
        {
            return $res[0];
        }    
        return NULL;
    }
    
    public function select_list($paging,$filters=array(),$order=array('id','ASC')) 
    {
        $this->db->select($this->_table_name.'.*, CONCAT(`user1`.first_name,\' \',`user1`.surename) as created_by, CONCAT(`user2`.first_name,\' \',`user2`.surename) as updated_by')
            ->from($this->_table_name)
            ->join('user_users as user1','user1.id = ' . $this->_table_name .'.created_by','LEFT')
            ->join('user_users as user2','user2.id = ' . $this->_table_name .'.updated_by','LEFT');
        
        $this->list_where($filters);
        $this->list_sort($order);
        $this->db->limit($paging["page_size"], $paging["page"] * $paging["page_size"]);
        $query = $this->db->get();
        
        return $query->result();
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
  
    /**
     * insert()
     * 
     * Insert a new app_models record into the database.
     * @params Array|App_modules_model
     * @return Array|bool
     */
    public function insert($data = NULL) 
    {
        if(!$data) 
        {
            $data = $this;
        }

        $updated_date = (new DateTime())->format('Y-m-d H:i:s');
        
        $record = (object) $data;
        $this->set_booleans($record);
        $record->created_date = $updated_date;
        $record->updated_date = $updated_date;
        $record->deleted_date = NULL;

        $res = $this->db->insert($this->_table_name,$data);
        $this->id = $this->db->insert_id();        
        return $res;
    }
    
    /**
     * update()
     * 
     * Updated an existing app_models record in the database.
     * @params Array|App_modules_model
     * @return Array|bool
     */
    public function update($data=null) 
    {
        if(!$data) 
        {
            $data = $this;
        }
        
        $updated_date = (new DateTime())->format('Y-m-d H:i:s');
        
        $record = (object) $data;
        $this->set_booleans($record);
        $record->updated_date = $updated_date;        
        $record = $this->set_record($record);
        
        return $this->db->replace($this->_table_name,$record);
    }
    
    /**
     * delete()
     * 
     * Delete an existing app_models record from the database. This delete is a soft delete, just making the record as deleted.
     * @params Array|App_modules_model
     * @return Array|bool
     */
    public function delete($data = NULL) 
    {
        if(!$data) 
        {
            $data = $this;
        }
        
        $updated_date = (new DateTime())->format('Y-m-d H:i:s');
        
        $record = (object) $data;
        $record->deleted_date = $updated_date;
        $record->deleted = 1;
        
        return $this->update($record);
    }
    
    public function convert_date_time($date_time,$to_database=false) {
        if(is_null($date_time))
            return $date_time;
        
        if($to_database) {
            $temp = DateTime::createFromFormat($this->_date_time_format, $date_time);
            if(!$temp) {
                if(strpos($date,"/")!==false) {
                    $date = str_replace("/", "-", $date);
                } else {
                    $date = str_replace("-", "/", $date);
                }
                $temp = DateTime::createFromFormat($this->_date_time_format, $date);
                if(!$temp){
                    throw new Exception("Invalid date format!");
                }
            }
            return $temp->format(Spagi_Model::DB_DATETIME_FORMAT);
        }
        $temp = DateTime::createFromFormat(Spagi_Model::DB_DATETIME_FORMAT, $date_time);
        
        if(!$temp){
            throw new Exception("Invalid date and time format!");
        }
        return $temp->format($this->_date_time_format);
    }
    
    public function convert_date($date,$to_database=false) {
        if(is_null($date))
            return $date;
        if($to_database) {
            $temp = DateTime::createFromFormat($this->_date_format, $date);
            if(!$temp) {
                if(strpos($date,"/")!==false) {
                    $date = str_replace("/", "-", $date);
                } else {
                    $date = str_replace("-", "/", $date);
                }
                $temp = DateTime::createFromFormat($this->_date_format, $date);
                
                if(!$temp){
                    throw new Exception("Invalid date format!");
                }
            }
            return $temp->format(Spagi_Model::DB_DATE_FORMAT);
        }
        
        $temp = DateTime::createFromFormat(Spagi_Model::DB_DATE_FORMAT, $date);
        if(!$temp){
            throw new Exception("Invalid date format!");
        }
        return $temp->format($this->_date_format);
    }

    public function convert_time($time,$to_database=false) {
        if(is_null($time))
            return $time;
        if($to_database) {
            $temp = DateTime::createFromFormat($this->_time_format, $time);
            if(!$temp){
                throw new Exception("Invalid time format!");
            }
            return $temp->format(Spagi_Model::DB_TIME_FORMAT);
        }
        
        $temp = DateTime::createFromFormat(Spagi_Model::DB_TIME_FORMAT, $time);
        if(!$temp){
            throw new Exception("Invalid time format!");
        }
        return $temp->format($this->_time_format);        
    }
    
    public function set_date_format($format) 
    {
        $this->_date_format = $format;
    }
    
    public function set_time_format($format) 
    {
        $this->_time_format = $format;
    }
    
    private function set_booleans(& $data) 
    {
        
        if(is_object($data)) {
            $data->deleted = (!isset($data->deleted) || !$data->deleted) ? 0 : 1;
            $data->active = (!isset($data->active) || !$data->active) ? 0 : 1;
        } else {
            $data["deleted"] = (!isset($data["deleted"]) || !$data["deleted"]) ? 0 : 1;
            $data["active"] = (!$data["active"] || !$data["active"]) ? 0 : 1;
        }
    }
    
    protected function set_record($data) 
    {
        if(is_object($data)) {
           $arr = get_object_vars($data);
        } else {
            $arr = $data;
        }
        if(isset($arr['id']) && is_numeric($arr['id'])) 
        {
            $row = $this->get_record($arr['id']);
            if($row) 
            {
                foreach($arr as $field => $value) 
                {
                    if($field[0] === "_")
                        continue;
                    
                    $row->$field = $value;
                }
                return $row;
            }
        }
        return NULL;
    }    
}
