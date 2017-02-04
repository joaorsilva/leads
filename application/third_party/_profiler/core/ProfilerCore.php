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
 * Default Location: third-party/SpagiProfiler/core
 */
require_once 'ProfilerCollectorInterface.php';
require_once 'ProfilerCollectorAbstract.php';
require_once 'ProfilerHooks.php';

class ProfilerCore {
    
    public $collectors = array();
    public $hooks;
    public $timers = array();
    public $errors = array();
    
    public function __construct() 
    {
        $this->hooks = new ProfilerHooks();
    }

    public function bootstrap() 
    {
        $timer = &$this->start_timer(__METHOD__);
        register_sp_handlers();
        $this->read_configuration();
        $this->hooks->boostrap();
        $this->stop_timer($timer);
    }

    public function &start_timer($function) 
    {
        $timer = array(
            'function'      => $function,
            'start_time'    => microtime(true),
            'stop_time'     => 0,
            'total_time'    => 0
        );
        
        $this->timers[$function][] = & $timer;
        return $timer;
    }
    
    public function stop_timer(&$timer)
    {
        if( !isset($timer['function'])   || 
            !isset($timer['start_time']) ||     
            !isset($timer['stop_time'])  || 
            !isset($timer['total_time']) ||
            !$timer['function']          ||    
            !$timer['start_time']        ||    
            $timer['stop_time']          ||    
            $timer['total_time'] 
        )
        {
            throw new Exception('Invalid timer parameter!');
        }
        
        $timer['stop_time'] = microtime(true);
        $timer['total_time'] = $timer['stop_time'] - $timer['start_time'];
    }
    
    public function add_error($class, $function, $message)
    {
        $this->errors[] = array(
            'class'     => $class,
            'function'  => $function,
            'message'   => $message
        );
    }        

    protected function read_configuration() 
    {
        if(!file_exists( PROFILERHOOKSFILE )) 
        {
            die(PROFILERHOOKSFILE);
            return;
        }

        require_once PROFILERHOOKSFILE;
        
        if(!isset($hooks))
        {
            return;
        }
        
        $this->hooks->register_hooks($hooks);
    }
    
    
}
