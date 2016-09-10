<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of User_users_model
 *
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 * @version 1.0
 * @package leads
 * @subpackage models
 * @copyright 2016 SPAGI Sistemas, ME
 */
class User_users_model extends CI_Model {
    
    protected $table_name = "user_users";
    
    public $id;
    public $first_name;
    public $surename;
    public $email;
    public $password;
    public $last_login;
    public $last_operation;
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
     * Constructs the User_users_model object.
     * @return User_users_model
     */
    public function __construct() {
        parent::__construct();
    }
    
    public function select_users_filter($filter) {
        $this->db->select('id, CONCAT(first_name," ",surename) as name');
        $this->db->from('user_users');
        $this->db->where('deleted = ', 0);
        if($filter) {
            $this->db->like('CONCAT(first_name," ",surename)',$filter,'both');
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * insert()
     * 
     * Insert a new user_users record into the database.
     * @params Array|class User_users_model
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
     * Updated an existing user_users record in the database.
     * @params Array|User_users_model
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
     * Delete an existing user_users record from the database. This delete is a soft delete, just making the record as deleted.
     * @params Array|User_users_model
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
