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

/*
 * SPAGI PROFILE BOOSTRAP 
 */

/*
 * Spagi Profiler PATHS  
 */
    define('PROFILERBASE', APPPATH . 'third_party/_profiler/');
    define('PROFILERCORE', APPPATH . 'third_party/_profiler/core/');
    define('PROFILERASSETS', 'profiler/assets/' );
    define('PROFILERAPP', PROFILERBASE . 'application/');
    define('PROFILERCONTROLLERS', PROFILERAPP . 'controllers/' );
    define('PROFILERVIEWS', PROFILERAPP . 'views/' );
    define('PROFILERLIB', PROFILERAPP . 'libraries/' );
    define('PROFILERCONF', PROFILERAPP . 'config/' );
    define('PROFILE',PROFILERBASE . 'profiles/');
    define('PROFILERDATAINDEX', PROFILERBASE . 'profiles/indexes/' );
    define('PROFILERDETAILS', PROFILERBASE . 'profiles/requests/' );
    define('PROFILERTEMP', PROFILERBASE . 'profiles/temp/' );
    define('PROFILERHOOKSFILE', PROFILERCONF . 'hooks.php' );
    define('CONTROLLER_INDEX',PROFILERCONTROLLERS . 'index.php');
    
/*
 * Load the Profiler Class
 */    
    
    require_once PROFILERCORE . 'ProfilerCore.php';
    require_once PROFILERCORE . 'ProfilerLibrary.php';
    
    if(!function_exists('get_sp_instance'))
    {
        function &get_sp_instance()
        {
            return $GLOBALS['SP'];
        }    
    }
    
    if(!function_exists('sp_error_handler'))
    {
        function sp_error_handler($severity, $message, $filepath, $line) {
            $SP = &get_sp_instance();
            $SP->hooks->error_handler($severity, $message, $filepath, $line);
        }
    }    
    
    if(!function_exists('sp_exception_handler'))
    {
        function sp_exception_handler($exception) {
            $SP = &get_sp_instance();
            $SP->hooks->exception_handler($exception);
        }
    }
    
    if(!function_exists('sp_shudown_handler'))
    {
        function sp_shudown_handler() {
            $SP = &get_sp_instance();
            $SP->hooks->pre_shudown();
        }        
    }    

    if(!function_exists('register_sp_handlers')) {
        
        function register_sp_handlers()
        {
            set_error_handler('sp_error_handler');
            set_exception_handler('sp_exception_handler');
            register_shutdown_function('sp_shudown_handler');            
        }        
    }
    
    $GLOBALS['SP'] = new ProfilerCore();
    $GLOBALS['SP']->bootstrap();
    
    
