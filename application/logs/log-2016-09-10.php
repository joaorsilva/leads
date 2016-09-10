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
