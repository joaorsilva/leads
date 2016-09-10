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
class App_actions_model extends CI_Model {
    
    protected $table_name = "app_actions";

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
    
    public function __construct() {
        parent::__construct();
    }
    
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
        $this->db->insert($this->table_name,$data);
    }
    
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
        return $this->update($data);
    }
}
