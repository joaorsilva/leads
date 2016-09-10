<?php
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
 * Default Location: third-party/SpagiProfiler/application/config
 */

/*
| -------------------------------------------------------------------
| HOOKS CONFIGURATION
| -------------------------------------------------------------------
|   Spagi Profiler supplies 7 hook points that can be used to call
| user defined classes and methods every time one of them runs.
| This classes muste be palced in the Profiler's libraries folder
| and are called collectors. 
|   In ceratin hooks the $CI object is present and will be set to your
| class through the set_CI public method present in the 
| ProfilerCollectorAbstract class, thus your collector classes must 
| extend that class. 
| The configuration is very simple and the same class and or 
| function may be used in more than one Profiler hook. 
|  
*/

$hooks = array();
// No $CI instance
$hooks['pre_ci'] = array(
    array(
        'class' => 'SpagiProfilerHeaders',
        'method' => 'collect',
        'disabled' => FALSE
        )
);
$hooks['pre_system'] = array();
// Good $CI instance
$hooks['pre_controller'] = array(
);
$hooks['post_controller_constructor'] = array(
    array(
        'class' => 'SpagiProfilerHeaders',
        'method' => 'collect2',
        'disabled' => FALSE
        )    
);
$hooks['post_controller'] = array();
$hooks['post_system'] = array();
// No $CI instance
$hooks['pre_shudown'] = array();