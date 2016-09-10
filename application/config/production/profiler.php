<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Profiler Sections
| -------------------------------------------------------------------------
| This file lets you determine whether or not various sections of Profiler
| data are displayed when the Profiler is enabled.
| Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/profiling.html
|
*/
$config['config']               = FALSE;
$config['queries']              = FALSE;
$config['benchmarks']           = FALSE;
$config['controller_info']      = FALSE;
$config['get']                  = FALSE;
$config['http_headers']         = FALSE;
$config['memory_usage']         = FALSE;
$config['post']                 = FALSE;
$config['queries']              = FALSE;
$config['uri_string']           = FALSE;
$config['session_data']         = FALSE;
$config['query_toggle_count']   = FALSE;

/*
|--------------------------------------------------------------------------
| Enable Application Profiler
|--------------------------------------------------------------------------
|
| If you are in development mode and wish to check information about 
| a specific call, you should set this value to TRUE.
|
| Note: The profiler must be disable for production environments as
| it adds an extra layer of code running besides your request.
|
*/
$config['profiler_enabled'] = FALSE;

/*
|--------------------------------------------------------------------------
| Path to the profiler directory
|--------------------------------------------------------------------------
|
| If you enable the application profiler you may set a different diretory
| to store the profiler data or leave it empty for the default
| application/profiler
|
|
*/
$config['profiler_path'] = '';