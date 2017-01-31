<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of unittest
 *
 * @author joao
 */
class Unittest {
    
    const START_COLOR   = "\033[";
    const END_COLOR = "\033[0m";
    const COLOR_DEFAULT = "0m";
    const COLOR_RED = "31m";
    const COLOR_YELLOW = "33m";
    const COLOR_GREEN = "32m";
    const COLOR_BLUE = "34m";
    
    const MESSAGE_INFO = 0;
    const MESSAGE_SUCCESS = 1;
    const MESSAGE_WARNING = 2;
    const MESSAGE_ERROR = 3;
    const MESSAGE_DEBUG = 4;
    const COOKIE_FILE = "/cookies/cookie.txt";
    const TIMEOUT = 5;
    const USER_AGENT = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko/20100101 Firefox/51.0"; //Firefox
    
    const METHOD_GET = "GET";
    const METHOD_DELETE = "DELETE";
    const METHOD_POST = "POST";
    const METHOD_PUT = "PUT";
    
    protected $ch;
    public static $login_url = "";
    public static $logout_url = "";
    public static $has_cookies = FALSE;
    public static $error_code = 0;
    public static $debug = FALSE;
    public static $tests = array();
    public static $test_error = "";
    public static $config = array();
    public static $authenticated = FALSE;
    public static $asserts = 0;
    public static $last_login = "";
    public static $verbose = FALSE;
    public static $modules = array();
    public static $methods = array();
    public static $total_modules = array();
    public static $total_methods = array();
    public static $total_asserts = 0;
    public static $screen_cols = 0;
          
    
    public static function load_config($dir,$env,$file) 
    {
        $path = $dir;
        
        if($env) 
        {
            $env = "/" . $env;
        }
        
        $path = $dir . $env . "/" . $file;
        
        if(!file_exists($path)) 
        {
            Unittest::print_message(Unittest::MESSAGE_ERROR,"Configuration file '" . $path . "' doesn't exists!");
            return FALSE;
        }
                
        require_once $path;
        self::$config = $config;
        
        return TRUE;
    }
    
    /**
     * Logs into the website
     * @param array $data
     * @param string $method
     * @return boolean
     */
    public static function login(array $data, $method =  Unittest::METHOD_GET) 
    {
        if(self::$authenticated != TRUE) 
        {        
            $query = "";
            if(!self::$login_url) 
            {
                self::print_message(Unittest::MESSAGE_ERROR, "No login url set!");
                return FALSE;
            }

            if($data)
            {    
                $query = http_build_query($data);
            }

            self::$last_login = self::execute(self::$login_url, $query, $method);
        }
        
        return self::$last_login;
    }
    
    /**
     * Logout from website
     * @param array $data
     * @param string $method
     * @return boolean
     */
    public static function logout(array $data, $method =  Unittest::METHOD_GET) 
    {
        $url = self::$logout_url;
        $query = "";
        if(!$url) {
            self::print_message(Unittest::MESSAGE_ERROR, "No logout url set!");
            return FALSE;
        }
        
        if($data)
        {    
            $query = http_build_query($data);
        }
        
        return self::execute($url, $query, $method);
    }
    
    /**
     * Runs a single test
     * @param array $data
     * @param string $method
     * @return boolean
     */
    public static function test($url, array $data, $method =  Unittest::METHOD_GET)
    {
        $query = "";
        if($data)
        {    
            $query = http_build_query($data);
        }
        
        return self::execute($url, $query, $method);       
    }
    
    /**
     * Loads the unit test files
     * @param array $test_files= array(
     *      'file_full_path', //Empty string for self file
     *      'class_name'
     *  )
     * @return boolean
     */
    public static function test_files(array $test_files) {
        
        if(!is_array($tests) || !is_array($tests[0])) 
        {
            self::print_message(Unittest::MESSAGE_ERROR, "Invalid test list!");
            return FALSE;
        }
        
        $new_tests = array();
        
        foreach($tests as $test) 
        {
            if(!is_array($test)) 
            {
                self::print_message(Unittest::MESSAGE_ERROR, "Invalid test file list. Test needs to be an array!");
                return FALSE;
            }
            if(count($test) != 2)
            {
                self::print_message(Unittest::MESSAGE_ERROR, "Test file list ruquires 2 parameters [file] and a [class name]!");
                return FALSE;
            }
            
            $class_file = $test["file"];
            $class_name = $test["class"];
            
            if(!$class_file || !$class_name) 
            {
                self::print_message(Unittest::MESSAGE_ERROR, "Test file list requires at least a [file] and [class name]!");
                return FALSE;
            }
            
            if(!file_exists($class_file))
            {
                self::print_message(Unittest::MESSAGE_ERROR, "Test file '" . $class_file . "' doen't exist!");
                return FALSE;
            }

            $parse_error = "";
            if(!php_check_syntax($class_file,$parse_error))
            {
                self::print_message(Unittest::MESSAGE_ERROR, "Test file '" . $class_file . "' has PHP errors!" . PHP_EOL . $parse_error . PHP_EOL);
                return FALSE;
            }

            require_once $class_file;
            
            if(!method_exists($class_name, "init")) 
            {
                self::print_message(Unittest::MESSAGE_WARNING, "On class '" . $class_name . "' the method init() isn't defined! Ignoring this class.");
                continue;
            }
            if(!is_callable($class_name."::init")) 
            {
                self::print_message(Unittest::MESSAGE_WARNING, "On class '" . $class_name . "' the method init() isn't callable! Ignoring this class.");
                continue;
            }
                        
            $ret = $class_name::init();
            if($ret === FALSE)
            {
                return FALSE;
            }
        }
        return TRUE;
    }
    
    /**
     * Loads the unit tests
     * @param array $tests= array(
     *      'file_full_path', //Empty string for self file
     *      'class_name'
     *  )
     * @return boolean
     */
    public static function add_tests(array $tests)
    {        
        foreach($tests as $test)
        {
            if(!is_array($test)) 
            {
                self::print_message(Unittest::MESSAGE_ERROR, "Invalid test. Test needs to be an array!");
                return FALSE;
            }
            
            $class_name = $test["class"];
            $method_name = $test["method"];
            $static_method = $class_name . "::" . $method_name;
            
            
            if(!$class_name)
            {
                self::print_message(Unittest::MESSAGE_ERROR, "Test list requires a [class name]!");
                return FALSE;
            }
            if(!class_exists($class_name))
            {
                self::print_message(Unittest::MESSAGE_ERROR, "Test class '" . $class_name . "' doesn't exist!");
                return FALSE;
            }
            
            
            if(!method_exists($class_name, $method_name)) {
                self::print_message(Unittest::MESSAGE_ERROR, "The method '" . $static_method . "' doesn't exist!");
                return FALSE;
            }

            if(!is_callable($static_method)) {
                self::print_message(Unittest::MESSAGE_ERROR, "The method '" . $static_method . "' isn't callable!");
                return FALSE;
            }
            
            if(!in_array($class_name,self::$modules)) {
                array_push(self::$modules,$class_name);
            }
            
            if(!in_array($static_method,self::$methods)) {
                array_push(self::$methods,$static_method);
            }
            
            array_push(self::$tests,$test);
        }
        return TRUE;
    }
    
    public static function assert_key(array $result, $key)
    {
        self::$asserts++;
        self::$total_asserts++;
        
        if(self::$verbose)
        {
            self::print_message(Unittest::MESSAGE_INFO,"  assert_key key [" . $key . "] ... ", FALSE);
        }
        
        if(!array_key_exists($key,$result))
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_ERROR);
            return FALSE;
        }

        if(self::$verbose)
            self::print_message(Unittest::MESSAGE_SUCCESS);
        
        return TRUE;
    }
    
    public static function assert_key_empty(array $result, $key)
    {
        self::$asserts++;
        self::$total_asserts++;

        if(self::$verbose)
        {
            self::print_message(Unittest::MESSAGE_INFO,"  assert_key_empty key [" . $key . "] ... ", FALSE);
        }
        
        if(!array_key_exists($key,$result))
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_ERROR);
            return FALSE;
        }
        
        if(!$result[$key])
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_SUCCESS);
            return TRUE;
        }
        
        if(self::$verbose)
            self::print_message(Unittest::MESSAGE_ERROR);
        
        return FALSE;
    }

    public static function assert_key_not_empty(array $result, $key)
    {
        self::$asserts++;
        self::$total_asserts++;

        if(self::$verbose)
        {
            self::print_message(Unittest::MESSAGE_INFO,"  assert_key_not_empty key [" . $key . "] ... ", FALSE);
        }
        
        if(!isset($result[$key]))
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_ERROR);
            return FALSE;
        }
        
        if(!$result[$key])
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_ERROR);
            return FALSE;
        }
        
        if(self::$verbose)
            self::print_message(Unittest::MESSAGE_SUCCESS);
        
        return TRUE;
    }
    
    public static function assert_equal(array $result, $key, $value)
    {
        self::$asserts++;
        self::$total_asserts++;

        if(self::$verbose)
        {
            self::print_message(Unittest::MESSAGE_INFO,"  assert_equal key [" . $key . "] value [" . $value . "] ... ", FALSE);
        }
        
        if(!isset($result[$key]) && $key == NULL)
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_SUCCESS);
            return TRUE;
        }
        else if(!isset($result[$key]))
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_ERROR);
            return FALSE;
        }

        if($result[$key] != $value)
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_ERROR);
            return FALSE;
        }
        
        if(self::$verbose)
            self::print_message(Unittest::MESSAGE_SUCCESS);
        
        return TRUE;
    }
    
    public static function assert_lesser(array $result, $key, $value)
    {
        self::$asserts++;
        self::$total_asserts++;
        
        if(self::$verbose)
        {
            self::print_message(Unittest::MESSAGE_INFO,"  assert_lesser key [" . $key . "] value [" . $value . "] ... ", FALSE);
        }
        
        if(!isset($result[$key]))
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_ERROR);
            return FALSE;
        }
        
        if(is_string($value))
        {
            if(strcmp($value, $result[$key]) < 0)
            {
                if(self::$verbose)
                    self::print_message(Unittest::MESSAGE_SUCCESS);
                return TRUE;
            }
        } 
        else if($value < $result[$key])
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_SUCCESS);
            return TRUE;
        }

        if(self::$verbose)        
            self::print_message(Unittest::MESSAGE_ERROR);
        
        return FALSE;
    }
    
    public static function assert_bigger(array $result, $key, $value)
    {
        self::$asserts++;
        self::$total_asserts++;
        
        if(self::$verbose)
        {
            self::print_message(Unittest::MESSAGE_INFO,"  assert_bigger key [" . $key . "] value [" . $value . "] ... ", FALSE);
        }

        if(!isset($result[$key]))
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_ERROR);
            return FALSE;
        }
        
        if(is_string($value))
        {
            if(strcmp($value, $result[$key]) > 0)
            {
                if(self::$verbose)
                    self::print_message(Unittest::MESSAGE_SUCCESS);
                return TRUE;
            }
        } 
        else if($value > $result[$key])
        {
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_SUCCESS);
            return TRUE;
        }
        
        if(self::$verbose)
            self::print_message(Unittest::MESSAGE_ERROR);
        
        return FALSE;
    }
    
    
    protected static function execute($url,$data,$method) 
    {
        self::$error_code = 0;
        self::$asserts = 0;
        
        $ch = curl_init();
        $request_url = $url;
        
        switch(strtolower($method)) 
        {
            case "delete":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            case "get":
                if($data)
                    $url .= "?" . $data;
                break;
            case "put":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            case "post":
                curl_setopt($ch,CURLOPT_POST,true);
                if($data) {
                    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
                }
                break;
            default:
                self::print_message(Unittest::MESSAGE_ERROR, "No login url set!");
                return FALSE;                
        }
                
        curl_setopt($ch,CURLOPT_URL,$request_url);
        curl_setopt($ch,CURLOPT_TIMEOUT,Unittest::TIMEOUT);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, FALSE);
        
        if(self::$debug) 
        {
            self::print_message(Unittest::MESSAGE_DEBUG, 
                    "Request:" . PHP_EOL .
                    "URL: " . $url . PHP_EOL . 
                    "Method: " . $method . PHP_EOL .
                    "Data: " . $data
                    );
        }
        
        if(self::$has_cookies)
        {
            curl_setopt($ch,CURLOPT_COOKIEJAR, __DIR__ . Unittest::COOKIE_FILE);
            curl_setopt($ch,CURLOPT_COOKIEFILE, __DIR__ . Unittest::COOKIE_FILE);
        }
        
        curl_setopt($ch,CURLOPT_USERAGENT,Unittest::USER_AGENT);
        
        $result = curl_exec($ch);
        
        if(self::$debug)
        {
            self::print_message(Unittest::MESSAGE_DEBUG,
                    "SERVER RETURNED: " . PHP_EOL . 
                    $result
                    );
        }
        
        $ret_code = $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if($ret_code < 200 || $ret_code > 299)
        {
            self::$error_code = $ret_code;
            self::print_message(Unittest::MESSAGE_ERROR, "HTTP Code: " . $ret_code);
            return FALSE;
        }
        
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($result, $header_size);
        
        if($result === FALSE) 
        {
            self::$error_code = curl_errno($ch);
            self::print_message(Unittest::MESSAGE_ERROR, $result);
            return FALSE;
        }
        curl_close($ch);
        
        return $body;
    }
    
    public static function run() 
    {
        
        self::print_message(Unittest::MESSAGE_INFO, "Unique tests");
        self::print_message(Unittest::MESSAGE_INFO, "Classes: " . count(self::$modules));
        self::print_message(Unittest::MESSAGE_INFO, "Methods: " . count(self::$methods));
        
        sleep(5);
        
        if(self::$debug) 
        {
            self::print_message(Unittest::MESSAGE_DEBUG, "All tests to run (in order)");
            foreach(self::$tests as $test)
            {
                self::print_message(Unittest::MESSAGE_DEBUG, $test["class"] . "::" . $test["method"] );
            }
        }
        
        foreach(self::$tests as $test) 
        {
            $class = $test["class"];
            $method = $test["method"];
            $static_method = $class . "::" . $method;
            
            if(self::$verbose)
                self::print_message(Unittest::MESSAGE_INFO,"Start: " . $class . "::" . $method . PHP_EOL);
            
            $ret = $class::$method();
            self::print_message(Unittest::MESSAGE_INFO,"Finish: " . $class . "::" . $method . " ... ", FALSE);
            if(!$ret) 
            {
                self::print_error();
                return FALSE;
            }
            self::print_success();
            
            if(!in_array($class, self::$total_modules)) {
                array_push(self::$total_modules,$class);
            }
            
            if(!in_array($static_method, self::$total_methods)) {
                array_push(self::$total_methods,$static_method);
            }

        }
        
        return TRUE;
    }
    
    protected static function print_error()
    {
        self::print_message(Unittest::MESSAGE_ERROR, "Asserts [" . str_pad(self::$asserts ,4," ",STR_PAD_LEFT). "]");
    }
    
    protected static function print_success()
    {
        self::print_message(Unittest::MESSAGE_SUCCESS, "Asserts [" . str_pad(self::$asserts ,4," ",STR_PAD_LEFT). "]");
    }    
    
    public static function print_message($type, $message="", $line_break = TRUE) 
    {
        self::$screen_cols = exec('tput cols');
        
        $message_len = ceil(0.7 * self::$screen_cols);
        $result = floor(0.3 * self::$screen_cols);
        
        /*var_dump(self::$screen_cols);
        var_dump($message_len);
        var_dump($result);
        die;*/
        
        if($message)
        {
            $message = " - " . $message;
        }
        
        $color = Unittest::COLOR_DEFAULT;
        $text = "[INFO   ]" . $message;
        switch ($type) {
            case Unittest::MESSAGE_SUCCESS:
                $color= Unittest::COLOR_GREEN;
                $text = "[SUCCESS]" . $message;
                $len = strlen($text) + strlen($message);
                if($len > $result) {
                    $text = substr($text, 0, $result);
                } else {
                    $text = str_pad($text, $result, " ", STR_PAD_LEFT);
                }
                break;
            case Unittest::MESSAGE_WARNING:
                $color= Unittest::COLOR_YELLOW;
                $text = "[WARNING]" . $message;
                $len = strlen($text) + strlen($message);
                if($len > $result) {
                    $text = substr($text, 0, $result);
                } else {
                    $text = str_pad($text, $result, " ", STR_PAD_LEFT);
                }
                break;
            case Unittest::MESSAGE_ERROR:
                $color= Unittest::COLOR_RED;
                $text = "[FAILED ]" . $message;
                $len = strlen($text) + strlen($message);
                if($len > $result) {
                    $text = substr($text, 0, $result);
                } else {
                    $text = str_pad($text, $result, " ", STR_PAD_LEFT);
                }
                break;
            case Unittest::MESSAGE_DEBUG:
                $color= Unittest::COLOR_BLUE;
                $text = "[DEBUG  ]" . $message;
                break;
            default:
                if(!strpos($text, PHP_EOL)) 
                {
                    $len = strlen($text);
                    if($len > $message_len) {
                        $text = substr($text, 0, $message_len);
                    } else {
                        $text = str_pad($text, $message_len, " ", STR_PAD_RIGHT);
                    }
                }
                break;
        }
                
        echo(Unittest::START_COLOR . $color . $text . Unittest::END_COLOR);
        if($line_break)
        {
            echo(PHP_EOL);
        }
    }
    
    protected static function print_debug($message) 
    {
        echo("[DEBUG]--------------------------------------------".PHP_EOL);
        echo("SERVER RETURNED:" . PHP_EOL);
        echo("---------------------------------------------------".PHP_EOL);
        echo($message . PHP_EOL);
        echo("---------------------------------------------------".PHP_EOL);
    }
    
}
