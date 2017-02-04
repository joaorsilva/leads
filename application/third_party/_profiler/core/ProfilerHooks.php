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
 * Default Location: third-party/_profiler/core
 */

class ProfilerHooks {
    
    public $hooks = array(
        'pre_ci',
        'pre_system',
        'pre_controller',
        'post_controller_constructor',
        'post_controller',
        'post_system',
        'pre_shudown',
        'error_handler',
        'exception_handler'
    );
    
    public $collectors = array();
    
    public function __construct() 
    {
        foreach($this->hooks as $hook)
        {
            $this->collectors[$hook] = array();
        }    
    }
    
    public function boostrap() 
    {
        
        /* Register the handles for the first time */
        $this->check_directories();
        $this->call_collectors('pre_ci');
    }
    
    public function pre_system()
    {
        /* Re-register the handles */
        $this->call_collectors(__FUNCTION__);
    }
    
    public function pre_controller() 
    {
        $this->call_collectors(__FUNCTION__);
    }
    
    public function post_controller_constructor() 
    {
        $this->call_collectors(__FUNCTION__);
    }
    
    public function post_controller() 
    {
        $this->call_collectors(__FUNCTION__);        
    }
    
    public function post_system() 
    {
        $this->call_collectors(__FUNCTION__);        
    }

    public function pre_shudown() 
    {
        $this->call_collectors(__FUNCTION__);        
        /* Calls CodeIgniter standard shutdown handler */
        if(function_exists('_shutdown_handler')) 
        {
            _shutdown_handler();
        }    
    }
    
    /**
     * error_handler
     * Runs on all PHP errors but not exceptions.
     * Sets the HTTP response code to 500.
     * 
     * @return void
     */
    public function error_handler($severity, $message, $filepath, $line) 
    {
        $data = array(
            'type'      => $this->err_type_string($severity),
            'message'   => $message,
            'file_path' => $filepath,
            'line'      => $line,
            'backtrace' => debug_backtrace()
        );
        
        $data['backtrace'] = array_slice($data['backtrace'], 1, count($data['backtrace'])-1);
        
        
        $this->call_collectors(__FUNCTION__, $data);
        
        if(function_exists('_error_handler'))
        {
            /* Calls CodeIgniter standard error handler */
            _error_handler($severity, $message, $filepath, $line);
        } else {
            var_dump($data);
        }
        
        http_response_code(500);
        exit(1);
    }
    
    /**
     * exception_handler
     * Runs on all PHP exceptions.
     * 
     * @return void
     */
    public function exception_handler($exception) 
    {
        $data = array(
            'type'      => 'EXCEPTION',
            'message'   => $exception->getMessage(),
            'file_path' => $exception->getFile(),
            'line'      => $exception->getLine(),
            'backtrace' => $exception->getTrace()
        );

        $this->call_collectors(__FUNCTION__, $data);
        
        if(function_exists('_exception_handler'))
        {
            /* Calls CodeIgniter standard exception handler */
            _exception_handler($exception);
        } else {
            var_dump($data);
        }
        
        http_response_code(500);
        exit(1);
    }

    protected function call_collectors($function_name, $data=NULL) 
    {
        $SP = & get_sp_instance();
        foreach($this->collectors[$function_name] as $collector)
        {
            switch($function_name)
            {
                case 'pre_ci':
                case 'pre_system':
                case 'pre_controller':
                case 'pre_shudown':
                    $obj = $collector['object'];
                    $method = $collector['method'];
                    $obj->$method($SP);
                    break;
                case 'error_handler':
                case 'exception_handler':
                    //$CI = & get_instance();
                    $obj = $collector['object'];
                    $method = $collector['method'];
                    $obj->$method($SP,NULL,$data);
                    break;
                default:
                    $CI = & get_instance();
                    $obj = $collector['object'];
                    $method = $collector['method'];
                    $obj->$method($SP,$CI);
                    break;
            }
        }            
    }    
    
    public function register_hooks($hooks) 
    {
        if(is_array($hooks))
        {
            $keys = array_keys($hooks);
            foreach($keys as $key)
            {   
                $this->collectors[$key] = array();
                if(array_search($key,$this->hooks) === FALSE) 
                {
                    throw new Exception('PROFILER: Configured hook \'' . $key . '\' isn\'t a valid profiler hook! Valid hooks are (' . implode(',',$keys) . '!');
                }
                foreach($hooks[$key] as $hook) 
                {
                    if(!isset($hook['disabled']) || $hook['disabled']) 
                    {
                        continue;
                    }

                    if (isset($hook['class']) && $hook['class']) 
                    {
                        if(!class_exists($hook['class']) && file_exists(PROFILERLIB . $hook['class'] . '.php')) 
                        {
                            require_once PROFILERLIB . $hook['class'] . '.php';
                        } 
                        else if (!file_exists(PROFILERLIB . $hook['class'] . '.php'))
                        {
                            throw new Exception('PROFILER: Collector file \'' . $hook['class'] . '.php' . '\' doesn\'t exist in \'' . PROFILERLIB . '\'!');
                        }

                        if(!class_exists($hook['class']))
                        {
                            throw new Exception('SPAGI PROFILER: Collector class \'' . $hook['class'] . '\' doesn\'t exist in \'' . PROFILERLIB . $hook['class'] . '\'!');
                        }

                        $obj = new $hook['class']();

                        if(isset($hook['method']) && method_exists($obj,$hook['method']))
                        {   
                            if(!isset($obj->class_name))
                            {
                                throw new Exception('PROFILER: Class \'' . $hook['class'] . '\' doesn\'t contain a public member class_name!');
                            }    
                            if(isset($this->collectors[$key][$obj->class_name]))
                            {
                                throw new Exception('PROFILER: Class \'' . $hook['class'] . '\' has an already defined class_name \'' . $obj->class_name . '\'!');
                            }
                            $this->collectors[$key][] = array(
                                'object'    =>  $obj,
                                'method'    =>  $hook['method'],
                                'class_name'      =>  $obj->class_name
                            ); 
                        } 
                        else 
                        {    
                            throw new Exception('PROFILER: Method \'' . $hook['method'] . '\' for Collector class \'' . $hook['class'] . '\' doesn\'t exist!');
                        }
                    }
                }
            }
        }
    }
    
    protected function check_directories() 
    {
        $this->create_directories(PROFILERDETAILS);
    }
    
    protected function create_directories($dir) 
    {
        if (!file_exists($dir)) 
        {
            if(!mkdir($dir, 0755, TRUE))
            {
                throw new Exception('PROFILER: Can\'t create directory \'' . $dir . '\'!' );
            }
        }        
    }
    
    protected function err_type_string($type)
    {
        switch($type)
        {
            case E_ERROR: // 1 //
                return 'E_ERROR';
            case E_WARNING: // 2 //
                return 'E_WARNING';
            case E_PARSE: // 4 //
                return 'E_PARSE';
            case E_NOTICE: // 8 //
                return 'E_NOTICE';
            case E_CORE_ERROR: // 16 //
                return 'E_CORE_ERROR';
            case E_CORE_WARNING: // 32 //
                return 'E_CORE_WARNING';
            case E_COMPILE_ERROR: // 64 //
                return 'E_COMPILE_ERROR';
            case E_COMPILE_WARNING: // 128 //
                return 'E_COMPILE_WARNING';
            case E_USER_ERROR: // 256 //
                return 'E_USER_ERROR';
            case E_USER_WARNING: // 512 //
                return 'E_USER_WARNING';
            case E_USER_NOTICE: // 1024 //
                return 'E_USER_NOTICE';
            case E_STRICT: // 2048 //
                return 'E_STRICT';
            case E_RECOVERABLE_ERROR: // 4096 //
                return 'E_RECOVERABLE_ERROR';
            case E_DEPRECATED: // 8192 //
                return 'E_DEPRECATED';
            case E_USER_DEPRECATED: // 16384 //
                return 'E_USER_DEPRECATED';
        }
        return "";
    }     
}
