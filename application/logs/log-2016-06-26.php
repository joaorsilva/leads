<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-06-26 00:48:41 --> Severity: error --> Exception: Unable to locate the model you have specified: Users_user_model /var/www/sites/leads/system/core/Loader.php 344
ERROR - 2016-06-26 00:48:54 --> Severity: error --> Exception: Unable to locate the model you have specified: Users_users_model /var/www/sites/leads/system/core/Loader.php 344
ERROR - 2016-06-26 00:48:56 --> Severity: error --> Exception: Unable to locate the model you have specified: Users_users_model /var/www/sites/leads/system/core/Loader.php 344
ERROR - 2016-06-26 00:49:28 --> Query error: Unknown column 'sure_name' in 'field list' - Invalid query: SELECT `id`, `first_name`, `sure_name`
FROM `user_users`
WHERE `deleted` >0
ERROR - 2016-06-26 00:50:46 --> Query error: FUNCTION leads.CONATC does not exist - Invalid query: SELECT `id`, CONATC(first_name, " ", surename)
FROM `user_users`
WHERE `deleted` >0
ERROR - 2016-06-26 01:00:44 --> Severity: Error --> Cannot use object of type stdClass as array /var/www/sites/leads/application/controllers/app/Modules.php 59
ERROR - 2016-06-26 01:48:51 --> Severity: Error --> Call to undefined method User_users_model::or_group_start() /var/www/sites/leads/application/models/User_users_model.php 48
ERROR - 2016-06-26 01:49:42 --> Severity: Error --> Call to undefined method User_users_model::or_group_start() /var/www/sites/leads/application/models/User_users_model.php 49
ERROR - 2016-06-26 01:50:02 --> Severity: Error --> Call to undefined method CI_DB_mysqli_driver::or_group_end() /var/www/sites/leads/application/models/User_users_model.php 52
ERROR - 2016-06-26 02:10:23 --> Severity: Warning --> Missing argument 1 for App_modules_model::select_list(), called in /var/www/sites/leads/application/controllers/app/Modules.php on line 57 and defined /var/www/sites/leads/application/models/App_modules_model.php 40
ERROR - 2016-06-26 02:10:23 --> Severity: Notice --> Undefined variable: table_name /var/www/sites/leads/application/models/App_modules_model.php 42
ERROR - 2016-06-26 02:10:23 --> Query error: No tables used - Invalid query: SELECT *
ORDER BY `id` ASC
ERROR - 2016-06-26 02:11:31 --> Severity: Notice --> Undefined variable: table_name /var/www/sites/leads/application/models/App_modules_model.php 42
ERROR - 2016-06-26 02:11:31 --> Query error: No tables used - Invalid query: SELECT *
ORDER BY `id` ASC
ERROR - 2016-06-26 02:58:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'JOIN `user_users` ON `user_users`.`id` = 
ORDER BY `id` ASC' at line 4 - Invalid query: SELECT *
FROM `app_modules`
JOIN `user_users` ON `user_users`.`id` = 
JOIN `user_users` ON `user_users`.`id` = 
ORDER BY `id` ASC
ERROR - 2016-06-26 02:59:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'JOIN `user_users` as `user2` ON `user2`.`id` = 
ORDER BY `id` ASC' at line 4 - Invalid query: SELECT *
FROM `app_modules`
JOIN `user_users` as `user1` ON `user1`.`id` = 
JOIN `user_users` as `user2` ON `user2`.`id` = 
ORDER BY `id` ASC
ERROR - 2016-06-26 02:59:58 --> Severity: Parsing Error --> syntax error, unexpected ''LEFT'' (T_CONSTANT_ENCAPSED_STRING) /var/www/sites/leads/application/models/App_modules_model.php 44
ERROR - 2016-06-26 02:59:58 --> Severity: Parsing Error --> syntax error, unexpected ''LEFT'' (T_CONSTANT_ENCAPSED_STRING) /var/www/sites/leads/application/models/App_modules_model.php 44
ERROR - 2016-06-26 03:00:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'JOIN `user_users` as `user2` ON `user2`.`id` = 
ORDER BY `id` ASC' at line 4 - Invalid query: SELECT *
FROM `app_modules`
JOIN `user_users` as `user1` ON `user1`.`id` = 
JOIN `user_users` as `user2` ON `user2`.`id` = 
ORDER BY `id` ASC
ERROR - 2016-06-26 03:00:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'JOIN `user_users` as `user2` ON `user2`.`id` = 
ORDER BY `id` ASC' at line 4 - Invalid query: SELECT *
FROM `app_modules`
JOIN `user_users` as `user1` ON `user1`.`id` = 
JOIN `user_users` as `user2` ON `user2`.`id` = 
ORDER BY `id` ASC
ERROR - 2016-06-26 03:01:12 --> Query error: Column 'id' in order clause is ambiguous - Invalid query: SELECT *
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `id` ASC
ERROR - 2016-06-26 03:03:14 --> Query error: Unknown column 'user1.name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(user1.name, ' ', user1.surename) as created_by, CONCAT(user1.name, ' ', user1.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.`id` ASC
ERROR - 2016-06-26 03:04:15 --> Query error: Unknown column 'user1.name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(user1.name, ' ', user1.surename) as created_by, CONCAT(user2.name, ' ', user2.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.`id` ASC
ERROR - 2016-06-26 03:04:51 --> Query error: Unknown column 'user1.name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.`id` ASC
ERROR - 2016-06-26 03:46:13 --> Severity: Notice --> Undefined index: css /var/www/sites/leads/application/views/outframes/admin_header.php 39
ERROR - 2016-06-26 03:46:13 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/sites/leads/application/views/outframes/admin_header.php 39
ERROR - 2016-06-26 03:46:13 --> Severity: Notice --> Undefined index: js /var/www/sites/leads/application/views/outframes/admin_footer.php 246
ERROR - 2016-06-26 03:46:13 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/sites/leads/application/views/outframes/admin_footer.php 246
ERROR - 2016-06-26 13:54:23 --> Severity: Notice --> Undefined property: Modules::$imput /var/www/sites/leads/application/controllers/app/Modules.php 58
ERROR - 2016-06-26 13:54:23 --> Severity: Error --> Call to a member function post() on a non-object /var/www/sites/leads/application/controllers/app/Modules.php 58
ERROR - 2016-06-26 13:58:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.
ERROR - 2016-06-26 13:58:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.
ERROR - 2016-06-26 14:00:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.
ERROR - 2016-06-26 14:03:58 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.
ERROR - 2016-06-26 14:04:50 --> Severity: Notice --> Undefined index: field /var/www/sites/leads/application/controllers/app/Modules.php 64
ERROR - 2016-06-26 14:04:50 --> Severity: Notice --> Undefined index: direction /var/www/sites/leads/application/controllers/app/Modules.php 65
ERROR - 2016-06-26 14:04:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.
ERROR - 2016-06-26 14:05:26 --> Severity: Notice --> Undefined index: field /var/www/sites/leads/application/controllers/app/Modules.php 64
ERROR - 2016-06-26 14:05:26 --> Severity: Notice --> Undefined index: direction /var/www/sites/leads/application/controllers/app/Modules.php 65
ERROR - 2016-06-26 14:05:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.
ERROR - 2016-06-26 14:07:06 --> Severity: Notice --> Undefined index: field /var/www/sites/leads/application/controllers/app/Modules.php 59
ERROR - 2016-06-26 14:18:31 --> Severity: Error --> Call to undefined method App_modules_model::order_by() /var/www/sites/leads/application/models/App_modules_model.php 51
ERROR - 2016-06-26 14:19:10 --> Query error: Unknown column 'user1.name' in 'order clause' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `user1`.`name` ASC
ERROR - 2016-06-26 14:40:43 --> Severity: Error --> Call to undefined method CI_DB_mysqli_result::get_compiled_select() /var/www/sites/leads/application/models/App_modules_model.php 63
ERROR - 2016-06-26 14:45:02 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.`active` DESC
ERROR - 2016-06-26 14:46:02 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.`active` DESC
ERROR - 2016-06-26 14:47:03 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.`deleted` ASC, `app_modules`.`active` DESC
ERROR - 2016-06-26 14:47:38 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.`deleted` ASC, `app_modules`.`active` DESC
ERROR - 2016-06-26 14:48:14 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.`deleted` DESC, `app_modules`.`active` ASC
ERROR - 2016-06-26 14:48:22 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.`deleted` ASC, `app_modules`.`active` DESC
ERROR - 2016-06-26 14:48:43 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.`id` ASC
ERROR - 2016-06-26 14:48:57 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.`id` ASC
ERROR - 2016-06-26 15:23:19 --> Severity: Notice --> Undefined variable: sort /var/www/sites/leads/application/models/App_modules_model.php 47
ERROR - 2016-06-26 15:23:19 --> Severity: Notice --> Undefined variable: order /var/www/sites/leads/application/models/App_modules_model.php 96
ERROR - 2016-06-26 15:23:19 --> Severity: Notice --> Undefined variable: order /var/www/sites/leads/application/models/App_modules_model.php 99
ERROR - 2016-06-26 15:23:19 --> Severity: Notice --> Undefined variable: order /var/www/sites/leads/application/models/App_modules_model.php 102
ERROR - 2016-06-26 15:23:19 --> Severity: Notice --> Undefined variable: order /var/www/sites/leads/application/models/App_modules_model.php 111
ERROR - 2016-06-26 15:23:19 --> Severity: Notice --> Undefined variable: order /var/www/sites/leads/application/models/App_modules_model.php 111
ERROR - 2016-06-26 15:23:19 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
ORDER BY `app_modules`.
ERROR - 2016-06-26 15:23:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/sites/leads/system/core/Exceptions.php:272) /var/www/sites/leads/system/core/Common.php 573
ERROR - 2016-06-26 17:35:25 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
WHERE `app_modules`.`id` = ''
AND  `app_modules`.`name` LIKE '%%' ESCAPE '!'
AND `app_modules`.`created_date` >= '2016-06-19 00:00:00'
AND `app_modules`.`created_date` <= '2016-06-19 00:00:00.99999'
ORDER BY `app_modules`.`created_date` DESC
ERROR - 2016-06-26 17:35:28 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
WHERE `app_modules`.`id` = ''
AND  `app_modules`.`name` LIKE '%%' ESCAPE '!'
AND `app_modules`.`created_date` >= '2016-06-19 00:00:00'
AND `app_modules`.`created_date` <= '2016-06-19 00:00:00.99999'
ORDER BY `app_modules`.`created_date` DESC
ERROR - 2016-06-26 17:36:19 --> Severity: Warning --> trim() expects parameter 1 to be string, array given /var/www/sites/leads/application/models/App_modules_model.php 74
ERROR - 2016-06-26 17:36:19 --> Severity: Warning --> trim() expects parameter 1 to be string, array given /var/www/sites/leads/application/models/App_modules_model.php 74
ERROR - 2016-06-26 17:36:19 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
WHERE `app_modules`.`created_date` >= '2016-06-19 00:00:00'
AND `app_modules`.`created_date` <= '2016-06-19 00:00:00.99999'
ORDER BY `app_modules`.`created_date` DESC
ERROR - 2016-06-26 17:38:02 --> Severity: Warning --> trim() expects parameter 1 to be string, array given /var/www/sites/leads/application/models/App_modules_model.php 74
ERROR - 2016-06-26 17:38:02 --> Severity: Warning --> trim() expects parameter 1 to be string, array given /var/www/sites/leads/application/models/App_modules_model.php 74
ERROR - 2016-06-26 17:41:37 --> Query error: Unknown column 'user11.id' in 'on clause' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user1` ON `user11`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
WHERE `app_modules`.`created_date` >= '06/16/2016 00:00:00'
AND `app_modules`.`created_date` <= '06/16/2016 23:59:59.99999'
ORDER BY `app_modules`.`id` ASC
ERROR - 2016-06-26 17:42:33 --> Query error: Unknown column 'user1.first_name' in 'field list' - Invalid query: SELECT `app_modules`.*, CONCAT(`user1`.first_name, ' ', `user1`.surename) as created_by, CONCAT(`user2`.first_name, ' ', `user2`.surename) as updated_by
FROM `app_modules`
LEFT JOIN `user_users` as `user11` ON `user1`.`id` = `app_modules`.`created_by`
LEFT JOIN `user_users` as `user2` ON `user2`.`id` = `app_modules`.`updated_by`
WHERE `app_modules`.`created_date` >= '2016-06-16 00:00:00'
AND `app_modules`.`created_date` <= '2016-06-16 23:59:59.99999'
ORDER BY `app_modules`.`id` ASC
