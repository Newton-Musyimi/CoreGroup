INSERT INTO `coregroup`.`employees` (`employee_id`, `first_name`, `last_name`, `email`, `title`, `mobile`, `address`) VALUES ('1', 'Newton', 'Musyimi', 'newtonmusyimi@gmail.com', 'CEO', '0791411796', 'Grahamstown, Eastern Cape');
INSERT INTO `coregroup`.`roles` (`role_id`, `role_name`) VALUES ('1', 'ADMINISTRATOR');
INSERT INTO `coregroup`.`roles` (`role_id`, `role_name`) VALUES ('2', 'RECEPTIONIST');
INSERT INTO `coregroup`.`roles` (`role_id`, `role_name`) VALUES ('3', 'TECHNICIAN');
INSERT INTO `coregroup`.`roles` (`role_id`, `role_name`) VALUES ('4', 'CLIENT');
INSERT INTO `coregroup`.`users` (`user_id`, `username`, `user_type`, `password`) VALUES ('1', 'newtonmusyimi', 'employee', '$2y$10$JOLVeoPQGFmMJgl52d.vU.IemcsZNAha5MiOFra/o.n8LuVPbsxhq');
INSERT INTO `coregroup`.`permissions` (`perm_id`, `perm_desc`) VALUES ('1', 'ADD NEW EMPLOYEE');
INSERT INTO `coregroup`.`permissions` (`perm_id`, `perm_desc`) VALUES ('2', 'ASSIGN RECEPTIONIST');
INSERT INTO `coregroup`.`permissions` (`perm_id`, `perm_desc`) VALUES ('3', 'REMOVE EMPLOYEE');
INSERT INTO `coregroup`.`role_perm` (`role_id`, `perm_id`) VALUES (1, 1);
INSERT INTO `coregroup`.`role_perm` (`role_id`, `perm_id`) VALUES (1, 2);
INSERT INTO `coregroup`.`role_perm` (`role_id`, `perm_id`) VALUES (1, 3);
INSERT INTO `coregroup`.`user_role`  (`user_id`, `role_id`) VALUES (1, 1);
