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

abstract class ProfilerCollectorAbstract implements ProfilerCollectorInterface 
{
    
    public $CI;
    public $SP;
    public $class_name = '';
    public $gid = 0;
    public $data = array();
    public $tab     = '';
    public $title   = '';
    public $icon    = '';

    public function __construct()
    {
        if(function_exists('get_instance')) 
        {
            $this->CI = & get_instance();
        }
        $this->SP = & get_sp_instance();
        $this->gid = getmyuid();
        $this->class_name = get_class($this);
        ProfilerLibrary::bootstrap();
    }
    
    public function register() {
        return $this->class_name;
    }
}
