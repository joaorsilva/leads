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
class User_users_model extends Spagi_Model {
    
    protected $_table_name = "user_users";
    
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
    
    public function validate_login($username,$password) {
        $this->db->select('*')
                ->from($this->_table_name)
                ->where('email = ',$username);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    public function select_users_filter($filter) {
        $this->db->select('id, CONCAT(first_name," ",surename) as name');
        $this->db->from($this->_table_name);
        $this->db->where('deleted = ', 0);
        if($filter) {
            $this->db->like('CONCAT(first_name," ",surename)',$filter,'both');
        }
        $query = $this->db->get();
        return $query->result();
    }
}
