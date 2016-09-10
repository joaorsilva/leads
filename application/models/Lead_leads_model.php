<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Lead_leads_model
 *
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 * @version 1.0
 * @package leads
 * @subpackage models
 * @copyright 2016 SPAGI Sistemas, ME
 */

class Lead_leads_model extends CI_Model {
    
    protected $table_name = "lead_leads";
    
    public $id;
    public $unit_organizations_id;
    public $lead_origins_id;
    public $lead_status_id;
    public $lead_subjects_id;
    public $lead_steps_id;
    public $owner_id;
    public $lead_priorities_id;
    public $cnt_contact_id;
    public $email;
    public $phone;
    public $other;
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
