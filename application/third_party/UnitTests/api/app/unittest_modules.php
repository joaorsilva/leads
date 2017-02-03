<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modules
 *
 * @author joao
 */
require_once __DIR__ . '/../../base/interfaces/Unittest.php';
require_once __DIR__ . '/../../base/Unittest.php';

class unittest_modules implements Unittest_Interface {
    
    protected static $record_id = 0;
    
    public static function init()
    {
        $tests = array(
            array("class" => __CLASS__, "method" => "create_record"),
            //array("class" => __CLASS__, "method" => "update_record"),
            array("class" => __CLASS__, "method" => "get_list"),
            array("class" => __CLASS__, "method" => "delete_record")
        );
        return Unittest::add_tests($tests);
    }
    
    public static function get_list() 
    {
        if(!self::login())
        {
            return FALSE;
        }
        
        $data = array();
        
        $res = Unittest::test(Unittest::$config['base_url'] . "/api/app/modules/", $data);
        $values = json_decode($res, true);
        
        return self::validate_packet_list($values);
    }
    
    public static function create_record()
    {
        if(!self::login())
        {
            return FALSE;
        }
        
        $data = array(
            "form"=>array(
                "name"=>"Module unit test 1",
                "active"=>1
            )
        );
        
        $res = Unittest::test(Unittest::$config['base_url'] . "/api/app/modules/", $data, "POST");
        $values = json_decode($res, true);
        
        return self::validate_packet_form($values);
    }
    
    public static function update_record() 
    {
        if(!self::login())
        {
            return FALSE;
        }
        
        $data = array(
            "form"=>array(
                "id"=>self::$record_id,
                "name"=>"Module unit test 2",
                "active"=>1
            )
        );
        
        $res = Unittest::test(Unittest::$config['base_url'] . "/api/app/modules/" . self::$record_id, $data, "PUT");
        $values = json_decode($res, true);
        
        return self::validate_packet_form($values);
    }
    
    public static function delete_record() 
    {
        if(!self::login())
        {
            return FALSE;
        }
        
        $data = array(
            "form"=>array(
                "id"=>self::$record_id,
                "name"=>"Module unit test 2",
                "active"=>1
            )
        );
        
        $res = Unittest::test(Unittest::$config['base_url'] . "/api/app/modules/" . self::$record_id, array(), "DELETE");
        $values = json_decode($res, true);
        
        return self::validate_packet_form($values);
    }        
    
    protected static function validate_packet_form($values)
    {
        $res = Unittest::assert_key($values, "rows");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'rows' field is missing from answer!");
            return FALSE;
        }
        
        $res = Unittest::assert_key($values, "error");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'error' field is missing from answer!");
            return FALSE;
        }

        $res = Unittest::assert_key_empty($values, "error");
        if(!$res) {
            $str_err = "";
            foreach($values['error'] as $err)
            {
                $str_err .= $err['message'] . PHP_EOL;
            }
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'error' isn't empty! Messages: " . $str_err);
            return FALSE;
        }
        
        $res = Unittest::assert_key_not_empty($values, "rows");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'rows' field is empty!");
            return FALSE;
        }
        
        $record = $values['rows'][0];

        return self::validate_record($record);        
    }
    
    protected static function validate_packet_list($values)
    {
        $res = self::validate_pagination($values);
        if(!$res) {
            return FALSE;
        }
        
        $res = self::validate_sort($values);
        if(!$res) {
            return FALSE;
        }

        $res = self::validate_filter($values);
        if(!$res) {
            return FALSE;
        }
        
        $res = Unittest::assert_key($values, "rows");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'rows' field is missing from answer!");
            return FALSE;
        }
        
        if($values["rows"])
        {
            foreach($values["rows"] as $row)
            {
                $res = self::validate_record($row);
                if(!$res)
                {
                    return FALSE;
                }
            }
        }

        return TRUE;
    }
    
    protected function validate_pagination($values) 
    {
        $res = Unittest::assert_key($values, "pagination");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'pagination' field is missing from answer!");
            return FALSE;
        }
        
        $pagination = $values["pagination"];
        $res = Unittest::assert_key($pagination, "page");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'pagination->page' field is missing from answer!");
            return FALSE;
        }
        
        $res = Unittest::assert_key($pagination, "page_size");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'pagination->page_size' field is missing from answer!");
            return FALSE;
        }
        
        $res = Unittest::assert_key($pagination, "pages");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'pagination->pages' field is missing from answer!");
            return FALSE;
        }

        $res = Unittest::assert_key($pagination, "start_page");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'pagination->start_page' field is missing from answer!");
            return FALSE;
        }

        $res = Unittest::assert_key($pagination, "end_page");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'pagination->end_page' field is missing from answer!");
            return FALSE;
        }

        $res = Unittest::assert_key($pagination, "start_row");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'pagination->start_row' field is missing from answer!");
            return FALSE;
        }

        $res = Unittest::assert_key($pagination, "end_row");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'pagination->end_row' field is missing from answer!");
            return FALSE;
        }

        $res = Unittest::assert_key($pagination, "total_rows");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'pagination->total_rows' field is missing from answer!");
            return FALSE;
        }

        return TRUE;
    }
    
    protected function validate_filter($values)
    {
        $res = Unittest::assert_key($values, "filter");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'filter' field is missing from answer!");
            return FALSE;
        }
        
        return TRUE;
    }
    
    protected function validate_sort($values)
    {
        $res = Unittest::assert_key($values, "sort");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'sort' field is missing from answer!");
            return FALSE;
        }
        
        $sort = $values["sort"];
        $res = Unittest::assert_key($sort, 0);
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'sort[0]' (field_name) field is missing from answer!");
            return FALSE;
        }
        
        $sort = $values["sort"];
        $res = Unittest::assert_key($sort, 1);
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'sort[1] (sort_direction)' field is missing from answer!");
            return FALSE;
        }

        return TRUE;
    }    
    
    protected static function validate_record(array $record)
    {
        $res = Unittest::assert_key($record, "id");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'id' field is missing from record!");
            return FALSE;
        }
        self::$record_id = $record['id'];
        
        $res = Unittest::assert_key($record, "name");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'name' field is missing from record!");
            return FALSE;
        }
        
        $res = Unittest::assert_key($record, "key");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'key' field is missing from record!");
            return FALSE;
        }
        
        $res = Unittest::assert_key($record, "active");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'active' field is missing from record!");
            return FALSE;
        }
        
        $res = Unittest::assert_key($record, "created_by");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'created_by' field is missing from record!");
            return FALSE;
        }

        $res = Unittest::assert_key($record, "created_date");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'created_date' field is missing from record!");
            return FALSE;
        }        

        $res = Unittest::assert_key($record, "updated_by");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'updated_by' field is missing from record!");
            return FALSE;
        }        

        $res = Unittest::assert_key($record, "updated_date");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'updated_date' field is missing from record!");
            return FALSE;
        }        

        $res = Unittest::assert_key($record, "deleted_by");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'deleted_by' field is missing from record!");
            return FALSE;
        }        

        $res = Unittest::assert_key($record, "deleted_date");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'deleted_date' field is missing from record!");
            return FALSE;
        }        

        $res = Unittest::assert_key($record, "deleted");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'deleted' field is missing from record!");
            return FALSE;
        }
        
        return TRUE;
    }
    
    protected static function login() 
    {
        Unittest::$has_cookies = TRUE;
        Unittest::$login_url = Unittest::$config['base_url'] . "/login/login";
        $data = array(
            "email"=>"joao.r.silva@gmail.com",
            "password"=> "cma32nil"
        );
        $res = Unittest::login($data, Unittest::METHOD_POST);
        $values = json_decode($res, true);
        
        if(isset($values["result"]) && ($values["result"] === "ok")) {
            return TRUE;
        }
        
        if(isset($values["message"]) && isset($values["result"]) && ($values["result"] === "error")) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"Login failed: " . $values["message"] . "!");
        } else {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"Login failed: Unknown reason!");
        }
        
        return FALSE;
        
        /*$res = Unittest::assert_key($values, "result");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'result' field is missing from answer!");
            return FALSE;
        }

        $res = Unittest::assert_key_not_empty($values, "result");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'result' field is empty!");
            return FALSE;
        }

        $res = Unittest::assert_key($values, "message");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'message' field is missing from answer!");
            return FALSE;
        }

        $res = Unittest::assert_key_not_empty($values, "message");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'message' field is empty!");
            return FALSE;
        }

        $res = Unittest::assert_equal($values, "result", "ok");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"result: " . $values["result"] . " - message: " . $values["result"]);
            return FALSE;
        }

        $res = Unittest::assert_key($values, "token");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'token' field is missing from answer!");
            return FALSE;
        }

        $res = Unittest::assert_key_not_empty($values, "token");
        if(!$res) {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"'token' field is empty!");
            return FALSE;
        }*/

        return TRUE;
    }
}
