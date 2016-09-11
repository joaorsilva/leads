<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-09-10 11:42:43 --> Severity: Notice --> Undefined property: Controllers::$App_modules_model /media/sf_Ubuntu/projects/leads/application/controllers/app/Controllers.php 148
ERROR - 2016-09-10 11:42:43 --> Severity: error --> Exception: Call to a member function select_list() on null /media/sf_Ubuntu/projects/leads/application/controllers/app/Controllers.php 148
ERROR - 2016-09-10 12:06:57 --> 404 Page Not Found: app/Modules/modules_filter
ERROR - 2016-09-10 12:07:05 --> 404 Page Not Found: app/Modules/modules_filter
ERROR - 2016-09-10 12:47:06 --> Query error: Unknown column 'app_modules.name' in 'field list' - Invalid query: SELECT `app_controllers`.*, `app_modules`.`name` as `app_controller_id`, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_controllers`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_controllers`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_controllers`.`updated_by`
INNER JOIN `app_modules` as `modules1` ON `modules1`.`id` = `app_controllers`.`app_modules_id`
WHERE   (
(`app_controllers`.`active` <>0 AND `app_controllers`.`deleted` =0) OR (`app_controllers`.`active` =0 AND `app_controllers`.`deleted` =0)
 )
ORDER BY `app_controllers`.`id` ASC
 LIMIT 10
ERROR - 2016-09-10 12:47:16 --> Severity: Warning --> Invalid argument supplied for foreach() /media/sf_Ubuntu/projects/leads/application/models/App_controllers_model.php 124
ERROR - 2016-09-10 12:47:16 --> Query error: Unknown column 'app_modules.name' in 'field list' - Invalid query: SELECT `app_controllers`.*, `app_modules`.`name` as `app_controller_id`, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_controllers`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_controllers`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_controllers`.`updated_by`
INNER JOIN `app_modules` as `modules1` ON `modules1`.`id` = `app_controllers`.`app_modules_id`
ORDER BY `app_controllers`.`id` ASC
 LIMIT 10
ERROR - 2016-09-10 12:48:51 --> Severity: Warning --> Invalid argument supplied for foreach() /media/sf_Ubuntu/projects/leads/application/models/App_controllers_model.php 124
ERROR - 2016-09-10 14:56:59 --> Severity: Warning --> array_merge(): Argument #2 is not an array /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_I18n.php 50
ERROR - 2016-09-10 14:57:58 --> Severity: Warning --> array_merge(): Argument #2 is not an array /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_I18n.php 50
ERROR - 2016-09-10 15:14:09 --> Severity: Warning --> array_merge(): Argument #2 is not an array /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_I18n.php 50
ERROR - 2016-09-10 15:16:02 --> Severity: error --> Exception: Translation file '/media/sf_Ubuntu/projects/leads/application/language/english/controllers/edit.json' invalid or malformed! /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_I18n.php 51
ERROR - 2016-09-10 15:26:56 --> Severity: error --> Exception: SPAGI_I18N: File '/media/sf_Ubuntu/projects/leads/application/language/english/controllers/index.json' invalid or malformed! /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_I18n.php 51
ERROR - 2016-09-10 16:15:41 --> 404 Page Not Found: app/Actions/index
ERROR - 2016-09-10 17:01:16 --> Severity: error --> Exception: SPAGI_I18N: File "/media/sf_Ubuntu/projects/leads/application/language/english/modules/index.json" doesn't exist /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_I18n.php 55
ERROR - 2016-09-10 17:04:52 --> Severity: error --> Exception: Call to undefined method Modules::load_library() /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 26
ERROR - 2016-09-10 17:05:16 --> Severity: Notice --> Undefined property: Spagi_Security::$load /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 30
ERROR - 2016-09-10 17:05:16 --> Severity: error --> Exception: Call to a member function helper() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 30
ERROR - 2016-09-10 17:06:07 --> Severity: error --> Exception: Call to undefined method Modules::jsonresponse() /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 33
ERROR - 2016-09-10 17:14:16 --> Severity: error --> Exception: syntax error, unexpected '}' /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 41
ERROR - 2016-09-10 17:28:32 --> Severity: Warning --> Missing argument 3 for Spagi_PageData::set_page(), called in /media/sf_Ubuntu/projects/leads/application/controllers/Login.php on line 19 and defined /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_PageData.php 32
ERROR - 2016-09-10 17:28:32 --> Severity: Notice --> Undefined variable: subtitle /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_PageData.php 37
ERROR - 2016-09-10 20:14:10 --> Unable to load the requested class: Spagi_Crypt
ERROR - 2016-09-10 20:14:29 --> Severity: Notice --> Undefined property: Spagi_Security::$config /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 24
ERROR - 2016-09-10 20:14:29 --> Severity: error --> Exception: Call to a member function item() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 24
ERROR - 2016-09-10 20:15:01 --> Severity: Notice --> Undefined property: Login::$encription /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 25
ERROR - 2016-09-10 20:15:01 --> Severity: error --> Exception: Call to a member function initialize() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 25
ERROR - 2016-09-10 20:15:31 --> Severity: Notice --> Undefined property: Login::$encription /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 25
ERROR - 2016-09-10 20:15:31 --> Severity: error --> Exception: Call to a member function initialize() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 25
ERROR - 2016-09-10 20:16:39 --> Severity: Notice --> Undefined property: Spagi_Security::$config /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 34
ERROR - 2016-09-10 20:16:39 --> Severity: error --> Exception: Call to a member function item() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 34
ERROR - 2016-09-10 20:29:07 --> 404 Page Not Found: Login/login
ERROR - 2016-09-10 20:29:29 --> 404 Page Not Found: Login/login
ERROR - 2016-09-10 20:39:33 --> Severity: error --> Exception: Call to undefined method Login::load_model() /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 92
ERROR - 2016-09-10 20:39:56 --> Severity: Notice --> Undefined property: Login::$user_users_model /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 93
ERROR - 2016-09-10 20:39:56 --> Severity: error --> Exception: Call to a member function validate_login() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 93
ERROR - 2016-09-10 20:42:09 --> Severity: Warning --> Creating default object from empty value /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 146
ERROR - 2016-09-10 20:42:09 --> Severity: Notice --> Undefined property: Login::$user_users_model /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 148
ERROR - 2016-09-10 20:42:09 --> Severity: error --> Exception: Call to a member function update() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 148
ERROR - 2016-09-10 20:43:08 --> Severity: Notice --> Undefined property: Login::$user_users_model /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 148
ERROR - 2016-09-10 20:43:08 --> Severity: error --> Exception: Call to a member function update() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 148
ERROR - 2016-09-10 20:44:01 --> Severity: Notice --> Undefined property: Login::$user_users_model /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 149
ERROR - 2016-09-10 20:44:01 --> Severity: error --> Exception: Call to a member function update() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 149
ERROR - 2016-09-10 20:44:26 --> Severity: Notice --> Undefined variable: user /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 149
ERROR - 2016-09-10 20:44:26 --> Severity: Notice --> Undefined property: Login::$table_name /media/sf_Ubuntu/projects/leads/system/core/Model.php 77
ERROR - 2016-09-10 20:44:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '(`id`, `first_name`, `surename`, `email`, `password`, `last_login`, `last_operat' at line 1 - Invalid query: REPLACE INTO  (`id`, `first_name`, `surename`, `email`, `password`, `last_login`, `last_operation`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `deleted_by`, `deleted_date`, `deleted`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-10 20:44:26', NULL, NULL, NULL)
ERROR - 2016-09-10 20:44:44 --> Severity: Notice --> Undefined property: Login::$table_name /media/sf_Ubuntu/projects/leads/system/core/Model.php 77
ERROR - 2016-09-10 20:44:44 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '(`id`, `first_name`, `surename`, `email`, `password`, `last_login`, `last_operat' at line 1 - Invalid query: REPLACE INTO  (`id`, `first_name`, `surename`, `email`, `password`, `last_login`, `last_operation`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `deleted_by`, `deleted_date`, `deleted`) VALUES ('2', 'João', 'Ribeiro da Silva', 'joao.r.silva@gmail.com', '46bc3d91430f90d44b68b1334b9a978e', '2016-09-10 20:44:44', '2016-09-10 20:44:44', '1', '1', '2016-06-26 00:00:00', '1', '2016-09-10 20:44:44', NULL, NULL, '0')
ERROR - 2016-09-10 20:46:02 --> Severity: Notice --> Undefined property: Login::$table_name /media/sf_Ubuntu/projects/leads/system/core/Model.php 77
ERROR - 2016-09-10 20:46:02 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '(`id`, `first_name`, `surename`, `email`, `password`, `last_login`, `last_operat' at line 1 - Invalid query: REPLACE INTO  (`id`, `first_name`, `surename`, `email`, `password`, `last_login`, `last_operation`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `deleted_by`, `deleted_date`, `deleted`) VALUES ('2', 'João', 'Ribeiro da Silva', 'joao.r.silva@gmail.com', '46bc3d91430f90d44b68b1334b9a978e', '2016-09-10 20:46:02', '2016-09-10 20:46:02', '1', '1', '2016-06-26 00:00:00', '1', '2016-09-10 20:46:02', NULL, NULL, '0')
ERROR - 2016-09-10 20:46:42 --> Severity: Notice --> Trying to get property of non-object /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 157
ERROR - 2016-09-10 20:46:42 --> Severity: Notice --> Trying to get property of non-object /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 158
ERROR - 2016-09-10 20:46:42 --> Severity: Notice --> Trying to get property of non-object /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 159
ERROR - 2016-09-10 20:46:42 --> Severity: Notice --> Trying to get property of non-object /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 160
ERROR - 2016-09-10 20:46:42 --> Severity: Notice --> Trying to get property of non-object /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 161
ERROR - 2016-09-10 20:46:42 --> Severity: Notice --> Undefined property: Spagi_Security::$encryption /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 164
ERROR - 2016-09-10 20:46:42 --> Severity: error --> Exception: Call to a member function encrypt() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 164
ERROR - 2016-09-10 20:46:42 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /media/sf_Ubuntu/projects/leads/system/core/Exceptions.php:272) /media/sf_Ubuntu/projects/leads/system/core/Common.php 573
ERROR - 2016-09-10 20:47:31 --> Severity: Notice --> Undefined property: Spagi_Security::$encryption /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 164
ERROR - 2016-09-10 20:47:31 --> Severity: error --> Exception: Call to a member function encrypt() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 164
ERROR - 2016-09-10 20:48:18 --> Severity: Warning --> openssl_encrypt() expects parameter 1 to be string, array given /media/sf_Ubuntu/projects/leads/system/libraries/Encryption.php 473
ERROR - 2016-09-10 20:53:22 --> 404 Page Not Found: app/Dashboard/index
ERROR - 2016-09-10 21:01:23 --> Severity: Notice --> Undefined property: Spagi_Security::$spagi_session /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 125
ERROR - 2016-09-10 21:01:23 --> Severity: error --> Exception: Call to a member function set() on null /media/sf_Ubuntu/projects/leads/application/libraries/Spagi_Security.php 125
ERROR - 2016-09-10 21:02:37 --> 404 Page Not Found: Login/app
