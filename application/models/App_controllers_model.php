<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of App_controllers_model
 *
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 * @version 1.0
 * @package leads
 * @subpackage models
 * @copyright 2016 SPAGI Sistemas, ME
 */
class App_controllers_model extends CI_Model {
    
    protected $table_name = "app_controllers";
    
    public $id;
    public $app_modules_id;
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
     * Constructs the App_controllers_model object.
     * @return App_controllers_model
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * insert()
     * 
     * Insert a new app_controllers record into the database.
     * @params Array|App_controllers_model
     * @return Array|bool
     */
    public function insert($data=null) {
        if(!$data) {
            $data = $this;
        }
        $updated_date = (new DateTime())->format('Y-m-d H:i:s');
        if(is_object($data)) {
            $data->created_date = $updated_date;
            $data->updated_date = $updated_date;
            $data->deleted_date = null;
        } else if(is_array($data)) {
            $data['created_date'] = $updated_date;
            $data['updated_date'] = $updated_date;
            $data['deleted_date'] = null;            
        }
        $this->id = $this->db->insert_id(); 
        return $this->db->insert($this->table_name,$data);
    }
    
    /**
     * update()
     * 
     * Updated an existing app_controllers record in the database.
     * @params Array|App_controllers_model
     * @return Array|bool
     */
    public function update($data=null) {
        if(!$data) {
            $data = $this;
        }
        $updated_date = (new DateTime())->format('Y-m-d H:i:s');
        if(is_object($data)) {
            $data->updated_date = $updated_date;
        } else if(is_array($data)) {
            $data['updated_date'] = $updated_date;
        }
        return $this->db->replace($this->table_name,$data);        
    }
    
    /**
     * delete()
     * 
     * Delete an existing app_controllers record from the database. This delete is a soft delete, just making the record as deleted.
     * @params Array|App_controllers_model
     * @return Array|bool
     */
    public function delete($data=null) {
        if(!$data) {
            $data = $this;
        }
        $updated_date = (new DateTime())->format('Y-m-d H:i:s');
        if(is_object($data)) {
            $data->deleted_date = $updated_date;
            $data->deleted = 1;
        } else if(is_array($data)) {
            $data['deleted_date'] = $updated_date;
            $data['deleted'] = 1;
        }
        return $this->updated($data);
    }    
}
