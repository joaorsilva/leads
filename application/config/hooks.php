<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller_constructor'][] = array(
    'class'    => 'ValidateUser',
    'function' => 'validate',
    'filename' => 'ValidateUser.php',
    'filepath' => 'hooks'
);

$hook['pre_system'][] = array(
    'class'    => 'SpagiProfiler',
    'function' => 'pre_system',
    'filename' => 'SpagiProfiler.php',
    'filepath' => 'hooks'
);
$hook['pre_controller'][] = array(
    'class'    => 'SpagiProfiler',
    'function' => 'pre_controller',
    'filename' => 'SpagiProfiler.php',
    'filepath' => 'hooks'
);

$hook['post_controller_constructor'][] = array(
    'class'    => 'SpagiProfiler',
    'function' => 'post_controller_constructor',
    'filename' => 'SpagiProfiler.php',
    'filepath' => 'hooks'
);

$hook['post_controller'][] = array(
    'class'    => 'SpagiProfiler',
    'function' => 'post_controller',
    'filename' => 'SpagiProfiler.php',
    'filepath' => 'hooks'
);

$hook['post_system'][] = array(
    'class'    => 'SpagiProfiler',
    'function' => 'post_system',
    'filename' => 'SpagiProfiler.php',
    'filepath' => 'hooks'
);

