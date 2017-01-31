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

class Modules extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function listrows() {
        
        $this->spagi_security->secure('rest');

        $this->load->library('Spagi_FormHandler');
        $this->load->library('Spagi_Pagination');
        $this->load->model('App_modules_model');
        
        $this->spagi_formhandler->request_type='list';
        $this->spagi_formhandler->receive(__METHOD__);
        
        $total_rows = $this->App_modules_model->select_count_list(
            $this->spagi_formhandler->filter
        );
        
        $this->spagi_formhandler->pagination['total_rows'] = $total_rows;
        
        $res = $this->App_modules_model->select_list(
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
        $this->load->model('App_modules_model');
        $this->spagi_formhandler->request_type = 'form';
        $this->spagi_formhandler->receive(__METHOD__,NULL,$code); 
        
        $res = array();
        if($num && is_numeric($num)) 
        {
            $res = $this->App_modules_model->get($num);
        }
        
        $this->spagi_formhandler->rows = $res;
        
        $code = 200;
        if(!$res) {
            $code = 404;
        }
        $this->spagi_formhandler->send(__METHOD__,NULL,$code);       
    }
    
    public function save($num=0) {
        
        $id = 0;
        $this->spagi_security->secure('rest');

        $this->load->library('Spagi_FormHandler');
        $this->load->model('App_modules_model');
        $this->spagi_formhandler->request_type = 'form';
        $this->spagi_formhandler->receive(__METHOD__);
        if(isset($this->spagi_formhandler->form["id"]) && is_numeric($this->spagi_formhandler->form["id"]))
        {
            if($this->validate($this->spagi_formhandler->form["id"])) 
            {
                $this->spagi_formhandler->form['key'] = md5($this->spagi_formhandler->form['name']);
                $record = $this->App_modules_model->get_record($this->spagi_formhandler->form['id']);
                $this->spagi_formhandler->form['created_by'] = $record->created_by;
                $this->spagi_formhandler->form['created_date'] = $record->created_date;
                $this->spagi_formhandler->form['updated_by'] = $this->spagi_security->user->id;
                $res = $this->App_modules_model->update($this->spagi_formhandler->form);
                if(!$res) {
                    $this->spagi_formhandler->send(__METHOD__,NULL,409);
                    return;
                }
                $id = $this->spagi_formhandler->form["id"];
                
            }
        } 
        else 
        {
            if($this->validate()) 
            {
                $this->spagi_formhandler->form['key'] = md5($this->spagi_formhandler->form['name']);
                $this->spagi_formhandler->form['created_by'] = $this->spagi_security->user->id;
                $this->spagi_formhandler->form['updated_by'] = $this->spagi_security->user->id;
                $res = $this->App_modules_model->insert($this->spagi_formhandler->form);
                if(!$res) {
                    $this->spagi_formhandler->send(__METHOD__,NULL,409);
                    return;
                }
                $id = $res;
            }
        }
        
        if($id) 
        {
            $this->spagi_formhandler->rows = array($this->App_modules_model->get_record($id));
        }
        
        $this->spagi_formhandler->send(__METHOD__);
    }
    
    public function delete($num=0) 
    {
        $id = 0;
        $this->spagi_security->secure('rest');
        $this->load->library('Spagi_FormHandler');
        $this->load->model('App_modules_model');
        $this->spagi_formhandler->request_type = 'delete';
        $this->spagi_formhandler->receive(__METHOD__);
        
        if($num) 
        {        
            $row = $this->App_modules_model->get_record($num);
            if($row) {
                $row->updated_by = $this->spagi_security->user->id;
                $row->deleted_by = $this->spagi_security->user->id;
                $this->App_modules_model->delete($row);
                $id = $row->id;
            }
        }
        
        $this->spagi_formhandler->rows = array();
        
        if($id) 
        {
<<<<<<< HEAD
            $this->spagi_formhandler->rows = array($this->App_modules_model->get_record($id));
=======
            $this->output->set_status_header(404);
            $this->output->set_output(''); 
            $this->output->_display();
            return;
>>>>>>> origin/master
        }
        
<<<<<<< HEAD
        $this->spagi_formhandler->send(__METHOD__);
=======
        $row = $this->App_modules_model->get_record($num);
        if($row ) {
            $row->updated_by = $this->spagi_security->user->id;
            $row->deleted_by = $this->spagi_security->user->id;
            $this->App_modules_model->delete($row);
        }

        $this->output->set_status_header(200);
        $this->output->set_output('',200);
        $this->output->_display();        
>>>>>>> origin/master
    }
    
    private function validate($id=0) 
    {
        if(!trim($this->spagi_formhandler->form['name'])) 
        {
            $this->spagi_formhandler->addError('form-name','This field must not be empty!');
        }
        
        $rows = $this->App_modules_model->query("id","name='" . $this->spagi_formhandler->form['name'] . "' AND deleted=0");
        if(isset($rows[0])) {
            if($rows[0]->id !== $id) {
                $this->spagi_formhandler->addError('form-name','The name must be unique!');
                return FALSE;
            }
        }
        
        if(count($this->spagi_formhandler->error)) 
        {
            return FALSE;
        }
        
        return TRUE;
    }
}
