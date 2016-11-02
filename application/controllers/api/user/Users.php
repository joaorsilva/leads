<?php
/**
 * Spagi Leads
 *
 * An open source leads manager
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2016 - 2016, SPAGI Systems
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	Spagi Leads
 * @author	SPAGI Systems
 * @copyright	Copyright (c) 2016 - 2016, SPAGI Systems (http://spagiweb.com.br/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://spagiweb.com.br
 * @since	Version 1.0.0
 * @filesource
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function listrows() {
        
        $this->spagi_security->secure('rest');

        $this->load->library('Spagi_FormHandler');
        $this->load->library('Spagi_Pagination');
        $this->load->model('User_users_model');
        
        $this->spagi_formhandler->request_type='list';
        $this->spagi_formhandler->receive(__METHOD__);
        
        $total_rows = $this->User_users_model->select_count_list(
            $this->spagi_formhandler->filter
        );
        
        $this->spagi_formhandler->pagination['total_rows'] = $total_rows;
        
        $res = $this->User_users_model->select_list(
            $this->spagi_formhandler->pagination,
            $this->spagi_formhandler->filter,
            $this->spagi_formhandler->sort
        );
        
        $pagination = $this->spagi_pagination->calculate(
            $this->spagi_formhandler->pagination['page'] * $this->spagi_formhandler->pagination['page_size'],
            $this->spagi_formhandler->pagination['page_size'],
            $this->spagi_formhandler->pagination['total_rows']
        );
        
        $this->spagi_formhandler->pagination = $pagination;
        $this->spagi_formhandler->rows = $res;

        $code = 200;
        if(!$res) {
            $code = 404;
        }

        $this->spagi_formhandler->send(__METHOD__,NULL,$code);
    }
    
    public function record($num=0) {
        $this->spagi_security->secure('rest');
        $this->load->library('Spagi_FormHandler');
        $this->load->model('User_users_model');
        $this->spagi_formhandler->request_type = 'form';
        $this->spagi_formhandler->receive(__METHOD__);
        
        $res = array();
        if($num && is_numeric($num)) 
        {
            $res = $this->User_users_model->get($num);
        }
        
        $this->spagi_formhandler->rows = $res;
        
        $code = 200;
        if(!$res) {
            $code = 404;
        }
        $this->spagi_formhandler->send(__METHOD__,NULL,$code);        
    }
    
    public function save($num=0) {
        
        $this->spagi_security->secure('rest');

        $this->load->library('Spagi_FormHandler');
        $this->load->model('User_users_model');
        $this->spagi_formhandler->request_type = 'form';
        $this->spagi_formhandler->receive(__METHOD__);
        if(isset($this->spagi_formhandler->form["id"]) && is_numeric($this->spagi_formhandler->form["id"]))
        {
            
            if($this->validate()) 
            {
                $this->spagi_formhandler->form['key'] = md5($this->spagi_formhandler->form['name']);
                $record = $this->User_users_model->get_record($this->spagi_formhandler->form['id']);
                $this->spagi_formhandler->form['created_by'] = $record->created_by;
                $this->spagi_formhandler->form['created_date'] = $record->created_date;
                $this->spagi_formhandler->form['updated_by'] = $this->spagi_security->user->id;
                $res = $this->User_users_model->update($this->spagi_formhandler->form);
            }
        } 
        else 
        {
            if($this->validate()) 
            {
                $this->spagi_formhandler->form['created_by'] = $this->spagi_security->user->id;
                $this->spagi_formhandler->form['updated_by'] = $this->spagi_security->user->id;
                $res = $this->User_users_model->insert($this->spagi_formhandler->form);
            }
        }
        
        $this->spagi_formhandler->send(__METHOD__);
    }
    
    public function delete($num=0) {
        $this->spagi_security->secure('rest');
        $this->load->model('User_users_model');
        $this->output->set_content_type('text/html');
        
        if(!$num) 
        {
            $this->output->set_output('',404);            
        }
        
        $row = $this->User_users_model->get_record($num);
        if($row ) {
            $row->updated_by = $this->spagi_security->user->id;
            $row->deleted_by = $this->spagi_security->user->id;
            $this->User_users_model->delete($row);
        }

        $this->output->set_output('',200);
        $this->output->_display();
    } 
    
    //TODO: Remake
    public function structure() {
        $structure = array(
            0=>array(
                'name'=>'id',
                'caption'=>'#',
                'type'=>'uint',
                'size' => '0',
                'related'=> FALSE,
                'required'=>FALSE,
                'disabled'=>TRUE,
                'help'=>''
            ),
            1=>array(
                'name'=>'first_name',
                'caption'=>'First name', //TODO: Translate
                'type'=>'string',
                'size' => '64',
                'related'=> FALSE,
                'required'=>TRUE,
                'disabled'=>FALSE,
                'help'=>''
            ),
            2=>array(
                'name'=>'surename',
                'caption'=>'Surename', //TODO: Translate
                'type'=>'string',
                'size' => '64',
                'related'=> FALSE,
                'required'=>TRUE,
                'disabled'=>FALSE,
                'help'=>''
            ),
            3=>array(
                'name'=>'email',
                'caption'=>'Email', //TODO: Translate
                'type'=>'string',
                'size' => '255',
                'related'=> FALSE,
                'required'=>TRUE,
                'disabled'=>FALSE,
                'help'=>''
            ),
            4=>array(
                'name'=>'email',
                'caption'=>'Email', //TODO: Translate
                'type'=>'string',
                'size' => '1024',
                'related'=> FALSE,
                'required'=>TRUE,
                'disabled'=>FALSE,
                'help'=>''
            ),
            5=>array(
                'name'=>'last_login',
                'caption'=>'Last login', //TODO: Translate
                'type'=>'datetime',
                'size' => '',
                'related'=> FALSE,
                'required'=>TRUE,
                'disabled'=>TRUE,
                'help'=>''
            ),
            6=>array(
                'name'=>'last_operation',
                'caption'=>'Last operation', //TODO: Translate
                'type'=>'datetime',
                'size' => '',
                'related'=> FALSE,
                'required'=>TRUE,
                'disabled'=>TRUE,
                'help'=>''
            ),
            7=>array(
                'name'=>'active',
                'caption'=>'Active', //TODO: Translate
                'type'=>'list',
                'list'=>array(
                    'values'=>array(
                        0=>'Inactive [translate]',
                        1=>'Active [translate]',
                        2=>'Deleted [translate]'
                        )
                    ),
                'size' => '1',
                'related'=> FALSE,
                'required'=>FALSE,
                'help'=>''
            ),
            8=>array(
                'name'=>'created_by',
                'caption'=>'Created by', //TODO: Translate
                'type'=>'list',
                'list'=>array(
                    'url'=>'/api/app/users',
                    'filter'=>array(
                        'deleted'=>0,
                    )
                ),
                'size' => '255',
                'related'=> TRUE,
                'required'=>FALSE,
                'disabled'=>TRUE,
                'help'=>''
            ),
            9=>array(
                'name'=>'created_date',
                'caption'=>'Created date', //TODO: Translate
                'type'=>'datetime',
                'size' => '0',
                'related'=> FALSE,
                'required'=>FALSE,
                'disabled'=>TRUE,
                'help'=>''
            ),
            10=>array(
                'name'=>'updated_by',
                'caption'=>'Updated by', //TODO: Translate
                'type'=>'string',
                'size' => '255',
                'related'=> TRUE,
                'required'=>FALSE,
                'disabled'=>TRUE,
                'help'=>''
            ),
            11=>array(
                'name'=>'updated_date',
                'caption'=>'Updated date', //TODO: Translate
                'type'=>'datetime',
                'size' => '0',
                'related'=> FALSE,
                'required'=>FALSE,
                'disabled'=>TRUE,
                'help'=>''
            ),
            12=>array(
                'name'=>'deleted_by',
                'caption'=>'Deleted by', //TODO: Translate
                'type'=>'string',
                'size' => '255',
                'related'=> TRUE,
                'required'=>FALSE,
                'disabled'=>TRUE,
                'help'=>''
            ),
            13=>array(
                'name'=>'deleted_date',
                'caption'=>'Deleted date', //TODO: Translate
                'type'=>'datetime',
                'size' => '0',
                'related'=> FALSE,
                'required'=>FALSE,
                'disabled'=>TRUE,
                'help'=>''
            ),
            14=>array(
                'name'=>'deleted',
                'caption'=>'Deleted', //TODO: Translate
                'type'=>'boolean',
                'size' => '1',
                'related'=> FALSE,
                'required'=>FALSE,
                'disabled'=>TRUE,
                'help'=>''
            )
        );
        $this->output->set_output(json_encode($structure),200);
        //$this->output->_display();
    }
    
    private function validate() 
    {
        if(!trim($this->spagi_formhandler->form['name'])) 
        {
            $this->spagi_formhandler->addError('form-name','This field must not be empty!');
        }
        
        if(count($this->spagi_formhandler->error)) 
        {
            return FALSE;
        }
        
        return TRUE;
    }
    
}
