<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Spagi Profiler
 *
 * An open source profiler module for CodeIgniter
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2016 - 2016, Spagi Sistemas, ME
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
 * @package	Spagi Profiler
 * @author	Spagi Sistemas
 * @copyright	Copyright (c) 2016 - 2016, Spagi Sistemas, ME (http://www.spagiweb.com)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://www.spagiweb.com
 * @since	Version 1.0.0
 * @filesource
 */

/*
 * Default Location: application/libraries
 */

/**
 * The ProfilerLibrary class is the heart of the profiler
 * supling all profiler functionality with exception to
 * the profiler controllers, profiler views and profiler hooks.
 * 
 * @see application/controllers/_profiler/IndexController.php for deails about Profiler Controllers.
 * @see application/views/_profiler/index.php for deails about request list View.
 * @see application/views/_profiler/request.php for deails about request detail View.
 * @see application/hooks/ProfilerHooks.php for deails about Profiler hooks.
 */

class ProfilerLibrary {
    
    public $CI;
    public static $init = FALSE;
    
    public function __construct() {
        if( !self::hasProfiler() ) return;
        $this->CI = & get_instance();
    }
    
    /*---------------------------------------------------------------
     * Handlers for Hooks from ProfilerHooks class
     *---------------------------------------------------------------
     */
    
    public static function bootstrap() {
        if( !self::hasProfiler() ) return;
        self::$init = TRUE;
        self::check_profiler_log();
        self::handle_bootstrap();
        self::$init = FALSE;
    }
    
    public static function handle_bootstrap()
    {
        $request = self::load_temp();
        $request->file->id = uniqid();
        $request->file->name = '';
        $request->request->time = (new DateTime())->format('Y-m-d H:i:s');
        $request->request->raw = file_get_contents("php://input");
        $request->request->headers = apache_request_headers();
        $request->request->method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';
        $request->request->uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $request->request->port = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : '';
        $request->request->host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
        $request->request->remote_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        $request->request->remote_host = isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : '';
        $request->request->protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] !="off" ? "HTTPS" : "HTTP";
        $request->request->url = $request->request->protocol . "://" . $request->request->host . $request->request->uri;
        $request->request->globals->request = $_REQUEST;
        $request->request->globals->vars = $_SERVER;
        $request->request->globals->get = $_GET;
        $request->request->globals->post = $_POST;
        $request->request->globals->cookeis = $_COOKIE;
        $request->request->globals->files = $_FILES;
        $request->request->globals->environment = $_ENV;
        $request->execution->times->start = microtime(TRUE);
        $request->execution->memory->limit = ini_get('memory_limit');
        $request->config->php = ini_get_all(null,true);
        $request->config->profiler = array('profiler_path'=>PROFILER_PATH,'prfiler_nimimal'=>PROFILER_MINIMAL);
        self::save_temp($request);
    }
    
    public static function handle_pre_system() {
        $request = self::load_temp();
        self::save_temp($request);
    }
    
    public static function handle_pre_controller() {
        $CI = & get_instance();
        $request = self::load_temp();
        
        self::save_temp($request);        
    }
    
    public static function handle_post_controller_constructor() {
        $CI = & get_instance();
        $request = self::load_temp();
        $request->request->ci_input->raw = $CI->input->raw_input_stream;
        
        $request->request->ci_input->get = $CI->input->get();
        $request->request->ci_input->post = $CI->input->post();
        $request->request->ci_input->cookie = $CI->input->cookie();
        $request->request->ci_input->server = '';
        self::save_temp($request);
    }
    
    public static function handle_post_controller() {
        $CI = & get_instance();
        $request = self::load_temp();
        $request->request->ci_uri = 'Unknown';
        if($CI->uri->uri_string !== '')
        {
            $request->request->ci_uri = $CI->uri->uri_string;
        }
        $request->request->session = $CI->session;
        $request->response->content_type = $CI->output->get_content_type();
        $request->execution->stack = debug_backtrace(  );
        $request->execution->controller = $CI->router->class;
        $request->execution->action =$CI->router->method;
        $request->config->ci = $CI->config->config;
        $request->database = self::get_databases();
        self::save_temp($request);
    }
    
    public static function handle_post_system() {
        $CI = & get_instance();
        $request = self::load_temp();
        //TODO: Post system operations
        self::save_temp($request);
    }
    
    public static function handle_error($data) {
        $request = self::load_temp();
        if(!$request->error) {
            $request->error = array();
        }
        $request->error[] = $data;
        self::save_temp($request);
    }
    
    public static function handle_shudown() {
        $request = self::load_temp();
        if(!$request->file->id)
            return;
        $request->execution->times->end = microtime(TRUE);
        $request->execution->times->total = $request->execution->times->end - $request->execution->times->start;
        $request->execution->memory->peak = memory_get_peak_usage(TRUE);
        $request->execution->memory->total = memory_get_usage(TRUE);
        $request->response->header = apache_response_headers();
        $request->response->code = http_response_code();
        
        self::save_temp($request);
        self::terminate($request->file->id);
    }
    

    /*---------------------------------------------------------------
     * File functions
     *---------------------------------------------------------------
     */
    
    private static function load_temp() {
        $temp_name = self::get_temp_name();
        if(!file_exists($temp_name)) 
        {
            return self::get_profiler_object();
        }
        $json = file_get_contents($temp_name);
        return json_decode($json);
    }
    
    private static function save_temp($data) {
        $temp_name = self::get_temp_name();
        file_put_contents($temp_name,json_encode($data,JSON_FORCE_OBJECT));
    }
    
    private static function terminate($file_id) {
        $temp_name = self::get_temp_name();
        $final_name = $file_id . '.json';
        $final_dir = PROFILER_PATH . 'requests/' . (new DateTime)->format('Ymd') . '/';
        self::create_directory($final_dir);
        rename($temp_name,$final_dir . $final_name);
        self::add_to_index($final_dir, $final_name);
    }
    
    private static function add_to_index($dir,$file_name) {
        $request = self::load_request($dir.$file_name);
        if(!$request) return;
        $index_data = array(
            'id' => $request->file->id,
            'status' => $request->response->code,
            'name' => str_replace(PROFILER_PATH . "requests/" ,"",$dir) . $file_name,
            'time' => $request->request->time,
            'method' => $request->request->method,
            'ip' => $request->request->remote_ip,
            'url' => $request->request->url,
            'query_count' =>$request->database->total_queries,
            'query_time' =>$request->database->total_query_times,
            'execution_time'=> $request->execution->times->total,
            'execution_memory'=> $request->execution->memory->peak,
        );
        self::save_index($index_data);
    }
    
    private static function save_index($data) {
        $index_name = PROFILER_PATH . 'indexes/idx_' . (new DateTime)->format('Ymd') . '.json';
        $fd = fopen($index_name,'a+');
        if($fd) {
            flock($fd, LOCK_EX);
            fwrite($fd,json_encode($data) . ',' . PHP_EOL);
            flock($fd, LOCK_UN);
            fclose($fd);
        }
    }
    
    /*---------------------------------------------------------------
     * Profiler Controller Api File functions
     *---------------------------------------------------------------
     */
    
    public static function load_request($file_name) {
        if(!file_exists($file_name)) {
            return false;
        }
        $json = file_get_contents($file_name);
        return json_decode($json);
    }
    
    public static function get_requests($row=0,$rows=10,$filter=array()) {
        $filter = self::parse_filter($filter);
        
        $filter_fields = array('ip','method','uri');
        $currentDate = DateTime::createFromFormat('Y-m-d H:i:s', $filter['end_date_time']);
        $startDate = DateTime::createFromFormat('Y-m-d H:i:s',$filter['start_date_time']);
        $row_count = 0;
        $result_set = array();
        while($currentDate >= $startDate) {
            $index_name = APPPATH . 'indexes/idx_' . $currentDate->format('Ymd') . '.json';            
            $request_rows = self::load_index($index_name);
            if(!$request_rows) {
                $currentDate = $currentDate->sub(new DateInterval("P1D"));
                continue;
            }    
            
            foreach($request_rows as $request_row) {
                $temp = null;
                if($request_row->time < $filter['start_date_time'] || $request_row->time > $filter['end_date_time'])
                    continue;
                $temp = $request_row;
                foreach($filter_fields as $filter_field) {
                    if(!$filter[$filter_field])
                        continue;
                    switch($filter_field){
                        case 'ip':
                            if(strpos($row->ip,$filter[$filter_field])===FALSE) $temp = null;    
                            break;
                        case 'method':
                            if(strnatcasecmp($row->ip,$filter[$filter_field])!==0) $temp = null;
                            break;
                        case 'uri':
                            if(strpos($row->ip,$filter[$filter_field])===FALSE) $temp = null;
                            break;
                    }   
                }
                if($temp) {
                    
                    $result_set[] = $temp;
                    $row_count++;
                }    
            }
            $currentDate = $currentDate->sub(new DateInterval("P1D"));
        }
        
        if($result_set) {
            usort($result_set, function($a, $b) {
                return strcmp($b->time,$a->time);
            });
            if($row > $row_count)
                $row = $row_count-$row;
            if($row < 0)
                $row=0;
            $result_set = array_slice($result_set,$row,$rows);
        }
        
        return array('result'=>'ok','message'=>array('rows'=>$result_set,'filter'=>$filter,'paging'=>array('row'=>$row,'rows'=>$rows,'total_rows'=>$row_count)));
    }
    
    public static function get_request($request) {
        $filename = PROFILER_PATH . 'requests/' . $request . '.json';
        $data = array();
        if(file_exists($filename)) {
            $json = file_get_contents($filename);
            $data = json_decode($json,JSON_FORCE_OBJECT);
        }
        return $data;
    }
    
    private static function load_index($filename) {
        if(!file_exists($filename))
            return NULL;
        $json = file_get_contents($filename);
        $json = rtrim($json,"\n\r ,");
        return json_decode('[' . $json . ']');
    }
    
    private static function parse_filter($filter) {
        $data = array();
        $data['start_date_time'] = (new DateTime())->setTime(0, 0, 0)->format('Y-m-d H:i:s');
        $data['end_date_time'] = (new DateTime())->setTime(23, 59, 59)->format('Y-m-d H:i:s');
        $data['ip'] = '';
        $data['method'] = '';
        $data['uri'] = '';
        if(isset($filter['day_start']) && trim($filter['day_start'])) {
            $date_start = trim($filter['day_start']) . ' 00:00:00';
            $data['start_date_time'] = DateTime::createFromFormat('Y-m-d H:i:s',$date_start);
            if($data['start_date_time'] === false) {
                return array('result'=>'error','message'=>array('field'=>'day_start','message'=>'Invalid start date!'));
            }
        }
        if(isset($filter['day_end']) && trim($filter['day_end'])) {
            $date_end = trim($filter['day_end']) . ' 23:59:59';
            $data['end_date_time'] = DateTime::createFromFormat('Y-m-d H:i:s',$date_end);
            if($data['end_date_time'] === false) {
                return array('result'=>'error','message'=>array('field'=>'day_end','message'=>'Invalid end date!'));
            }
        }
        if(isset($filter['ip']) && trim($filter['ip'])) {
            $data['ip'] = trim($filter['ip']);
        }
        if(isset($filter['method']) && trim($filter['method'])) {
            $data['method'] = trim($filter['method']);
        }
        if(isset($filter['uri']) && trim($filter['uri'])) {
            $data['uri'] = trim($filter['uri']);
        }
        return $data;
    }
    
    /*---------------------------------------------------------------
     * Helper functions
     *---------------------------------------------------------------
     */
    
    private static function check_profiler_log() 
    {
        self::create_directory(APPPATH . 'temp/');
        self::create_directory(APPPATH . 'requests/');
        self::create_directory(APPPATH . 'indexes/');
    }

    private static function create_directory($dir) {
        if (!file_exists($dir)) 
        {
            if(!mkdir($dir, 0755, TRUE) && self::$init === TRUE)
            {
                throw new Exception('PROFILER: Can\'t create profiler directory \'' . $dir . '\'!' );
            }
        }
    }
    
    private static function get_temp_name() {
        $pid = getmypid();
        return PROFILER_PATH . 'temp/' . $pid . '.json';        
    }
    
    private static function get_databases() {
        $CI = & get_instance();
        $dbs = array();
        foreach (get_object_vars($CI) as $name => $cobject)
        {
            if (is_object($cobject)) {
                if ($cobject instanceof CI_DB)
                {
                        $dbs[get_class($CI).':$'.$name] = $cobject;
                }
                elseif ($cobject instanceof CI_Model)
                {
                        foreach (get_object_vars($cobject) as $mname => $mobject)
                        {
                                if ($mobject instanceof CI_DB)
                                {
                                        $dbs[get_class($cobject).':$'.$mname] = $mobject;
                                }
                        }
                }                
            }
        }
        if (count($dbs) === 0) {
            return array();
        }
        
        $rows = array();
        $rows['total_query_times'] = 0.0;
        $rows['total_queries'] = 0;
        $rows['total_databases'] = count($dbs);
        $rows['databases'] = array();
        $count=0;
        foreach ($dbs as $name => $db) {
            $rows['databases'][$count]['query_times'] = (float)number_format(array_sum($db->query_times), 4);
            $rows['total_query_times'] += $rows['databases'][$count]['query_times'];
            $rows['total_queries'] += count($db->queries);
            
            $rows['databases'][$count]['name'] = $db->database . '@' . $db->hostname;
            $rows['databases'][$count]['driver'] = array();
            $rows['databases'][$count]['driver']['driver_type'] = $db->dbdriver;
            $rows['databases'][$count]['driver']['compress'] = $db->compress;
            $rows['databases'][$count]['driver']['delete_hack'] = $db->delete_hack;
            $rows['databases'][$count]['driver']['stricton'] = $db->stricton;
            $rows['databases'][$count]['driver']['dsn'] = $db->dsn;
            $rows['databases'][$count]['driver']['username'] = $db->username;
            $rows['databases'][$count]['driver']['hostname'] = $db->hostname;
            $rows['databases'][$count]['driver']['database'] = $db->database;
            $rows['databases'][$count]['driver']['subdriver'] = $db->subdriver;
            $rows['databases'][$count]['driver']['dbprefix'] = $db->dbprefix;
            $rows['databases'][$count]['driver']['char_set'] = $db->char_set;
            $rows['databases'][$count]['driver']['dbcollat'] = $db->dbcollat;
            $rows['databases'][$count]['driver']['encrypt'] = $db->encrypt;
            $rows['databases'][$count]['driver']['swap_pre'] = $db->swap_pre;
            $rows['databases'][$count]['driver']['port'] = $db->port;
            $rows['databases'][$count]['driver']['pconnect'] = $db->pconnect;
            $rows['databases'][$count]['driver']['result_id'] = $db->result_id;
            $rows['databases'][$count]['driver']['db_debug'] = $db->db_debug;
            $rows['databases'][$count]['driver']['benchmark'] = $db->benchmark;
            $rows['databases'][$count]['driver']['query_count'] = $db->query_count;
            $rows['databases'][$count]['driver']['bind_marker'] = $db->bind_marker;
            $rows['databases'][$count]['driver']['save_queries'] = $db->save_queries;
            $rows['databases'][$count]['driver']['queries'] = $db->queries;
            $rows['databases'][$count]['driver']['query_times'] = $db->query_times;
            $rows['databases'][$count]['driver']['data_cache'] = $db->data_cache;
            $rows['databases'][$count]['driver']['trans_enabled'] = $db->trans_enabled;
            $rows['databases'][$count]['driver']['trans_strict'] = $db->trans_strict;
            $rows['databases'][$count]['driver']['cache_on'] = $db->cache_on;
            $rows['databases'][$count]['driver']['cachedir'] = $db->cachedir;
            $rows['databases'][$count]['driver']['cache_autodel'] = $db->cache_autodel;
            $rows['databases'][$count]['driver']['CACHE'] = $db->CACHE;
            $rows['databases'][$count]['driver']['failover'] = $db->failover;
            
            $rows['databases'][$count]['client']['affected_rows'] = $db->conn_id->affected_rows;
            $rows['databases'][$count]['client']['client_info'] = $db->conn_id->client_info;
            $rows['databases'][$count]['client']['client_version'] = $db->conn_id->client_version;
            $rows['databases'][$count]['client']['connect_errno'] = $db->conn_id->connect_errno;
            $rows['databases'][$count]['client']['connect_error'] = $db->conn_id->connect_error;
            $rows['databases'][$count]['client']['errno'] = $db->conn_id->errno;
            $rows['databases'][$count]['client']['error'] = $db->conn_id->error;
            $rows['databases'][$count]['client']['error_list'] = $db->conn_id->error_list;
            $rows['databases'][$count]['client']['field_count'] = $db->conn_id->field_count;
            $rows['databases'][$count]['client']['host_info'] = $db->conn_id->host_info;
            $rows['databases'][$count]['client']['info'] = $db->conn_id->info;
            $rows['databases'][$count]['client']['insert_id'] = $db->conn_id->insert_id;
            $rows['databases'][$count]['client']['server_info'] = $db->conn_id->server_info;
            $rows['databases'][$count]['client']['server_version'] = $db->conn_id->server_version;
            $rows['databases'][$count]['client']['stat'] = $db->conn_id->stat;
            $rows['databases'][$count]['client']['sqlstate'] = $db->conn_id->sqlstate;
            $rows['databases'][$count]['client']['protocol_version'] = $db->conn_id->protocol_version;
            $rows['databases'][$count]['client']['thread_id'] = $db->conn_id->thread_id;
            $rows['databases'][$count]['client']['warning_count'] = $db->conn_id->warning_count;
            $count++;
        }
        return $rows;
    }
    
    public static function get_profiler_object() {
        $obj = new stdClass(); //ok
        $obj->file = new stdClass(); //ok
        $obj->file->id = null; //ok
        $obj->file->name = null;
        $obj->request = new stdClass(); //ok
        $obj->request->raw = null; //ok
        $obj->request->time = null; //ok
        $obj->request->uri = null; //ok
        $obj->request->port = null; //ok
        $obj->request->host = null; //ok
        $obj->request->remote_ip = null; //ok
        $obj->request->remote_host = null; //ok
        $obj->request->ci_uri = null; //ok
        $obj->request->method = null; //ok
        $obj->request->content_type = null;
        $obj->request->headers = null; //ok
        $obj->request->globals = new stdClass(); //ok
        $obj->request->globals->request = null; //ok
        $obj->request->globals->vars = null; //ok
        $obj->request->globals->get = null; //ok
        $obj->request->globals->post = null; //ok
        $obj->request->globals->cookeis = null; //ok
        $obj->request->globals->files = null; //ok
        $obj->request->globals->environment = null; //ok
        $obj->request->ci_input = new stdClass();
        $obj->request->ci_input->raw = null;
        $obj->request->ci_input->post = null;
        $obj->request->ci_input->get = null;
        $obj->request->ci_input->put = null;
        $obj->request->ci_input->server = null;
        
        $obj->response = new stdClass();
        $obj->response->header = null; //ok
        $obj->response->code = null; //ok
        $obj->response->raw_content = null;
        $obj->response->content_type = null; //ok
        $obj->response->ci_content = null; 
        
        $obj->errors = null; //ok
        
        $obj->config = new stdClass();
        $obj->config->ci = null; //ok
        $obj->config->php = null; //ok
        $obj->config->profiler = null; //ok
        
        $obj->session = null; //ok
        
        $obj->execution = new stdClass();
        $obj->execution->times = new stdClass();
        $obj->execution->times->start = null; //ok
        $obj->execution->times->end = null; //ok
        $obj->execution->times->total = null; //ok
        $obj->execution->memory = new stdClass();
        $obj->execution->memory->total = null; //ok
        $obj->execution->memory->peak = null; //ok
        $obj->execution->controller = null; //ok
        $obj->execution->action = null; //ok
        $obj->execution->stack = null; //ok
        
        $obj->database = null;
        
        return $obj;
    }
    
    public static function hasProfiler() {
        if(!defined('PROFILER_PATH') 
                || !defined('PROFILER_ENABLED') 
                || PROFILER_ENABLED !== TRUE) 
        {
            return false;
        }
        return true;        
    }    
}
