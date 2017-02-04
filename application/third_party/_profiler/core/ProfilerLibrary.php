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
    public static $request = array(
        "file"=> array(
            "id"=>null,
            "name"=>null,
            "dir"=>null
        ),
        "request"=>array(
            "raw"=> null,
            "time"=>null,
            "uri"=>null,
            "port"=>null,
            "host"=>null,
            "remote_ip"=>null,
            "remote_host"=>null,
            "ci_uri"=>null,
            "method"=>null,
            "content_type"=>null,
            "headers"=>null,
            "globals"=> array(
                "request"=>null,
                "vars"=> null,
                "get"=> null,
                "post"=>null,
                "cookeis"=>null,
                "files"=>null,
                "environment"=>null
            ),
            "ci_input"=> array(
                "raw"=>null,
                "post"=>null,
                "get"=>null,
                "put"=>null,
                "server"=>null
            )
        ),
        "response"=> array(
            "header"=>null,
            "code"=>null,
            "raw_content"=>null,
            "content_type"=>null
        ),
        "config"=>array(
            "ci"=>null,
            "php"=>null,
            "profiler"=>null
        ),
        "session"=> null,
        "execution"=>array(
            "times"=>array(
                "start"=>null,
                "end"=>null,
                "total"=>null
            ),
            "memory"=> array(
                "total"=>null,
                "peak"=>null
            ),
            "controller"=>null,
            "action"=>null,
            "stack"=>null
        ),
        "database"=>array(),
        "error"=>array()
    );
    
    public static $log = TRUE;
    public static $log_files = array();
    
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

        if(substr($_SERVER['REQUEST_URI'],0,strlen('/_profiler')) == '/_profiler')
        {
            self::$log = FALSE;
            return;
        }

        self::$init = FALSE;
    }
    
    public static function handle_bootstrap()
    {
        
        self::$request['file']['id'] = uniqid();
        self::$request['file']['name'] = self::$request['file']['id'] . ".log";
        self::$request['file']['dir'] = "";
        
        self::save(self::$request);

        self::$request['request']['time'] = (new DateTime())->format('Y-m-d H:i:s');
        self::$request['request']['raw'] = file_get_contents("php://input");
        self::$request['request']['headers'] = apache_request_headers();
        self::$request['request']['method'] = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        if($pos = strpos($uri,"?"))
        {
            $uri = substr($uri,0,$pos);
        }       
        self::$request['request']['uri'] = $uri;
        self::$request['request']['port'] = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : '';
        self::$request['request']['host'] = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
        self::$request['request']['remote_ip'] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        self::$request['request']['remote_host'] = isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : '';
        self::$request['request']['protocol'] = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] !="off" ? "HTTPS" : "HTTP";
        self::$request['request']['url'] = self::$request['request']['protocol'] . "://" . self::$request['request']['host'] . self::$request['request']['uri'];
        self::$request['request']['globals']['request'] = $_REQUEST;
        self::$request['request']['globals']['vars'] = $_SERVER;
        self::$request['request']['globals']['get'] = $_GET;
        self::$request['request']['globals']['post'] = $_POST;
        self::$request['request']['globals']['cookeis'] = $_COOKIE;
        self::$request['request']['globals']['files'] = $_FILES;
        self::$request['request']['globals']['environment'] = $_ENV;
        self::$request['execution']['times']['start'] = microtime(TRUE);
        self::$request['execution']['memory']['limit'] = ini_get('memory_limit');
        self::$request['config']['php'] = ini_get_all(null,TRUE);
        self::$request['config']['profiler_path'] = PROFILERBASE;
        self::save(self::$request);
    }
    
    public static function handle_pre_system() {
        self::save_temp($request);
    }
    
    public static function handle_pre_controller() {
        $CI = & get_instance();
        self::save_temp($request);
    }
    
    public static function handle_post_controller_constructor() {
        $CI = & get_instance();
        self::save_temp($request);
    }
    
    public static function handle_post_controller() {
        $CI = & get_instance();
        self::$request['database'] = self::get_databases();
        self::$request['execution']['stack'] = self::get_execution($CI);
        self::save(self::$request);
    }
    
    public static function handle_post_system() {
        
        self::save(self::$request);
    }
    
    public static function handle_error($data) {
        self::$request['error'][] = $data;
        self::save(self::$request);
    }
    
    public static function handle_shudown() {
        
        self::$request['execution']['memory']['peak'] = memory_get_peak_usage();
        self::$request['execution']['times']['end'] = microtime(TRUE);
        self::$request['execution']['times']['total'] = self::$request['execution']['times']['end'] - self::$request['execution']['times']['start'];
        self::$request['response']['header'] = apache_response_headers();
        self::$request['response']['code'] = http_response_code();
        self::save(self::$request);
    }
    

    /*---------------------------------------------------------------
     * File functions
     *---------------------------------------------------------------
     */
    
    private static function save($data) 
    {
        if(!self::$log)
        {
            return;
        }

        $dir = (new DateTime)->format('Ymd') . '/';
        if(!is_dir(PROFILERDETAILS . $dir)) {
            if(!mkdir(PROFILERDETAILS . $dir)) {
                throw new Exception('PROFILER: Can\'t create profiler directory \'' . $dir . '\'!' );
            }
        }
        if(!$data['file']['dir']) 
        {
            $data['file']['dir'] = $dir;
        }
        file_put_contents(PROFILERDETAILS . $data['file']['dir'] . $data['file']['name'], serialize($data));
    }
    
    public static function load($filename) 
    {
        return unserialize(file_get_contents($filename));
    }
    
    public static function get_logs($request) 
    {
        $filter = self::parse_filter($request);
        
        self::get_log_dirs(PROFILERDETAILS);
        usort(self::$log_files, 
            function ($a, $b)
            {
                $res = strcmp($b['time'],$a['time']);
                if($res == 0)
                {
                    $res = strcmp($b['name'],$a['name']);
                }    
                return $res;
            }
        );
        
        $current = 0;
        foreach(self::$log_files as $log_file)
        {
            $contents = self::load($log_file['dir'] . '/' . $log_file['file']);
            if($contents) {
               
                self::$log_files[$current]['id'] = $contents['file']['id'];
                self::$log_files[$current]['name'] = $contents['file']['name'];
                self::$log_files[$current]['dir'] = $contents['file']['dir'];
                self::$log_files[$current]['status'] = $contents['response']['code'];
                self::$log_files[$current]['method'] = $contents['request']['method'];
                self::$log_files[$current]['ip'] = $contents['request']['remote_ip'];
                self::$log_files[$current]['url'] = $contents['request']['url'];
                if($contents['database']) {
                    self::$log_files[$current]['queries'] = $contents['database']['total_queries'];
                    self::$log_files[$current]['queries_times'] = $contents['database']['total_query_times'];
                }
                self::$log_files[$current]['total'] = 0;
                self::$log_files[$current]['memory_peak'] = $contents['execution']['memory']['peak'];
                self::$log_files[$current]['execution_time'] = $contents['execution']['times']['total'];
                self::$log_files[$current]['time'] = $log_file['time'];
            }
            $current++;
        }
        //TODO: Get extra data (status,ip,method, url,queries, queries times,execution time, memory peak, time)
        //var_dump(self::$log_files);die;
        
        
        $paging = array(
            'total_rows' => count(self::$log_files),
            'rows' => $filter['page_size'],
            'row'=>$filter['page'] * $filter['page_size']
        );
        
        self::$log_files = array_slice(self::$log_files,$paging['row'],$paging['rows']);
        
        return array(
            'rows' => self::$log_files,
            'paging' => $paging,
            'filter' => $filter
        );
    }
    
    private static function get_log_dirs($dir) 
    {
        if(substr($dir, strlen($dir)-1, 1) == "/") {
            $dir = substr($dir, 0, strlen($dir)-1);
        }
        
        if(!$dir_handle = opendir($dir)) 
        {
            throw new Exception('PROFILER: Can\'t create open directory \'' . $dir . '\'!' );
        }
        
        while(false !== ($entry = readdir($dir_handle))) 
        {
            if ($entry == "." || $entry == "..")
            {
                continue;
            }
            
            if(is_dir($dir. "/" . $entry))
            {
                self::get_log_dirs($dir . '/' . $entry);
                continue;
            }
            
            if($path_parts = pathinfo($dir . '/' . $entry))
            {
                if($path_parts['extension'] != 'log')
                {
                    continue;
                }                    
            }

            $date = new DateTime();
            $date->setTimestamp(filemtime($path_parts['dirname'] . '/' . $path_parts['basename']));
            $date->setTimezone(new DateTimeZone(date_default_timezone_get()));
            array_push(
                self::$log_files,
                array(
                    'dir'               => $path_parts['dirname'],
                    'file'              => $path_parts['basename'],
                    'name'              => $path_parts['filename'],
                    'time'              => $date->format("Y-m-d H:i:s"),
                    'status'            => NULL,
                    'ip'                => NULL,
                    'url'               => NULL,
                    'queries'           => NULL,
                    'queries_times'     => NULL,
                    'execution_time'    => NULL,
                    'memory_peak'       => NULL
                )
            );
            
        }
        
        closedir($dir_handle);
        
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
       
    public static function get_request($request) {
        $data = array();
        $filename = PROFILERDETAILS . $request . '.log';
        if(file_exists($filename)) {
            $data = self::load($filename);
        }
        return $data;
    }
    
    private static function get_execution($CI) {
        
        $profile = array();
        foreach ($CI->benchmark->marker as $key => $val)
        {
            // We match the "end" marker so that the list ends
            // up in the order that it was defined
            if (preg_match('/(.+?)_end$/i', $key, $match)
                    && isset($CI->benchmark->marker[$match[1].'_end'], $CI->benchmark->marker[$match[1].'_start']))
            {
                    $profile[$match[1]] = $CI->benchmark->elapsed_time($match[1].'_start', $key);
            }
        }
        return $profile;
    }


    private static function parse_filter($filter) 
    {
        /*$data = array();
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
        
        $data['page'] = 0;
        if(isset($filter['page']) && $filter['page']) 
        {
            $data['page'] = $filter['page'];
        }
        
        $data['page_size'] = 10;
        if(isset($filter['page_size']) && $filter['page_size'])
        {
            $data['page_size'] = $filter['page_size'];
        }
        
        return $data;*/
    }
    
    /*---------------------------------------------------------------
     * Helper functions
     *---------------------------------------------------------------
     */
    
    private static function check_profiler_log() 
    {
        self::create_directory(PROFILE . 'requests/');
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
        //var_dump($rows);die;
        return $rows;
    }
    
    public static function hasProfiler() {
        if(!defined('PROFILERBASE') 
                || !defined('PROFILER_ENABLED') 
                || PROFILER_ENABLED !== TRUE) 
        {
            return false;
        }
        return true;        
    }    
}
