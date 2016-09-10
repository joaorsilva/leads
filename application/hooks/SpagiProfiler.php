<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter Profiler
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
 * @package	CodeIgniter Profiler
 * @author	Spagi Sistemas
 * @copyright	Copyright (c) 2016 - 2016, Spagi Sistemas, ME (http://www.spagiweb.com)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://www.spagiweb.com
 * @since	Version 1.0.0
 * @filesource
 */

/*
 * Default Location: application/hooks
 */

/**
 * The SpagiProfilerHooks class is responsible to supply all 
 * profiler's CodeIgniter hooks.
 * It's important that the hooks are registered in your 
 * application/config/hooks.php
 * @see application/config/hooks.php for more details.
 */

class SpagiProfiler
{
    /**
     * pre_system Hook
     * Called after CodeIgniter Core and benchmarks class.
     * Stub for third_party/SpagiProfiler/core/SpagiProfilerHooks::pre_system()
     * 
     * @return void
     */
    public static function pre_system() 
    {
        if(function_exists('get_sp_instance')) 
        {
            $SP = & get_sp_instance();
            $SP->hooks->pre_system();    
        }
    }
    
    /**
     * pre_controller Hook
     * Called just before the controller is called, after routing, etc.
     * Stub for third_party/SpagiProfiler/core/SpagiProfilerHooks::pre_controller()
     * 
     * @return void
     */
    public static function pre_controller() 
    {
        if(function_exists('get_sp_instance')) 
        {
            $SP = & get_sp_instance();
            $SP->hooks->pre_controller();    
        }
    }
    
    /**
     * post_controller Hook
     * Called just after the controller has been constructed.
     * Before calling the controller's action
     * Stub for third_party/SpagiProfiler/core/SpagiProfilerHooks::post_controller_constructor()
     * 
     * @return void
     */
    public static function post_controller_constructor() 
    {
        if(function_exists('get_sp_instance')) 
        {
            $SP = & get_sp_instance();
            $SP->hooks->post_controller_constructor();    
        }
    }
    
    /**
     * post_controller Hook
     * Called just after the controller has returned.
     * Stub for third_party/SpagiProfiler/core/SpagiProfilerHooks::ost_controller()
     * 
     * @return void
     */
    public static function post_controller() 
    {
        if(function_exists('get_sp_instance')) 
        {
            $SP = & get_sp_instance();
            $SP->hooks->post_controller();    
        }
    }
    
    /**
     * post_system Hook
     * Called just beforCodeIgniter terminates.
     * Stub for third_party/SpagiProfiler/core/SpagiProfilerHooks::post_controller()
     * 
     * @return void
     */
    public static function post_system() 
    {
        if(function_exists('get_sp_instance')) 
        {
            $SP = & get_sp_instance();
            $SP->hooks->post_system();    
        }
    }    
}
