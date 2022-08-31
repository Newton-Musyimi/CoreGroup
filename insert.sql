INSERT INTO `coregroup`.`employees` (`employee_id`, `first_name`, `last_name`, `email`, `title`, `mobile`, `address`)
VALUES ('1', 'Newton', 'Musyimi', 'newtonmusyimi@gmail.com', 'CEO', '0791411796', 'Grahamstown, Eastern Cape');
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

-- Language: sql
INSERT INTO `coregroup`.`employees` (`employee_id`, `first_name`, `last_name`, `email`, `title`, `mobile`, `address`)
VALUES ('1', 'first', 'last', 'email', 'title', 'mobile', 'address');

--
ALTER TABLE `coregroup`.`users`
DROP FOREIGN KEY `employeeid_fk`,
DROP FOREIGN KEY `clientid_fk`;

ALTER TABLE `coregroup`.`employees`
    CHANGE COLUMN `address` `address` TEXT NULL ;

ALTER TABLE `coregroup`.`workorders`
DROP FOREIGN KEY `client_fk`;
ALTER TABLE `coregroup`.`workorders`
DROP INDEX `client_fk_idx` ;
;

-- make client id auto-inc then run below code:
ALTER TABLE `coregroup`.`workorders`
    ADD INDEX `clientid_fk_idx` (`client_id` ASC) VISIBLE;
;
ALTER TABLE `coregroup`.`workorders`
    ADD CONSTRAINT `clientid_fk`
        FOREIGN KEY (`client_id`)
            REFERENCES `coregroup`.`clients` (`client_id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;
-- update based on lecturer corrections
ALTER TABLE `coregroup`.`payments`
    DROP FOREIGN KEY `invoice_id_fk`;
ALTER TABLE `coregroup`.`payments`
    DROP INDEX `invoice_id_fk_idx` ;
ALTER TABLE `coregroup`.`workorders`
    DROP FOREIGN KEY `requested_by_fk`;
ALTER TABLE `coregroup`.`workorders`
    DROP INDEX `requested_by_fk_idx` ;
ALTER TABLE `coregroup`.`workorders`
    CHANGE COLUMN `requested_by` `requested_by` VARCHAR(20) NOT NULL ;
ALTER TABLE `coregroup`.`user_role`
    DROP FOREIGN KEY `user_role_ibfk_1`;
ALTER TABLE `coregroup`.`user_role`
    CHANGE COLUMN `user_id` `employee_id` INT(10) UNSIGNED NOT NULL ,
    DROP INDEX `user_id` ;
ALTER TABLE `coregroup`.`user_role`
    RENAME TO  `coregroup`.`employee_role` ;
DROP TABLE `coregroup`.`payments`;
ALTER TABLE `coregroup`.`invoices`
    DROP COLUMN `balance`;
ALTER TABLE `coregroup`.`clients`
    ADD COLUMN `username` VARCHAR(20) NOT NULL AFTER `address`,
    ADD COLUMN `password` VARCHAR(60) NOT NULL AFTER `username`,
    ADD UNIQUE INDEX `username_UNIQUE` (`username` ASC);
ALTER TABLE `coregroup`.`employees`
    ADD COLUMN `username` VARCHAR(20) NOT NULL AFTER `address`,
    ADD COLUMN `password` VARCHAR(60) NULL AFTER `username`,
    ADD UNIQUE INDEX `username_UNIQUE` (`username` ASC);
DROP TABLE `coregroup`.`users`;
ALTER TABLE `coregroup`.`invoices`
    CHANGE COLUMN `payment_status` `payment_status` TINYINT NOT NULL DEFAULT 0 ;
ALTER TABLE `coregroup`.`invoices`
    DROP FOREIGN KEY `quote_id_fk`;
ALTER TABLE `coregroup`.`invoices`
    ADD CONSTRAINT `quote_id`
        FOREIGN KEY (`invoice_id`)
            REFERENCES `coregroup`.`quotes` (`quote_id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;
ALTER TABLE `coregroup`.`devices`
    DROP FOREIGN KEY `owner_id_fk`;
ALTER TABLE `coregroup`.`devices`
    ADD INDEX `owner_id_fk_idx` (`owner_id` ASC),
    DROP INDEX `owner_id_fk_idx` ;
;
ALTER TABLE `coregroup`.`devices`
    ADD CONSTRAINT `owner_id_fk`
        FOREIGN KEY (`owner_id`)
            REFERENCES `coregroup`.`clients` (`client_id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;
ALTER TABLE `coregroup`.`documents`
    DROP FOREIGN KEY `file_uploader_fk`;
ALTER TABLE `coregroup`.`documents`
    CHANGE COLUMN `uploaded_by` `uploaded_by` VARCHAR(20) NULL DEFAULT NULL ,
    DROP INDEX `file_uploader_fk_idx` ;
ALTER TABLE `coregroup`.`logs`
    DROP FOREIGN KEY `log_user_id_fk`;
ALTER TABLE `coregroup`.`logs`
    CHANGE COLUMN `user_id` `employee_id` INT(10) UNSIGNED NULL DEFAULT NULL ,
    ADD INDEX `log_user_id_fk_idx` (`employee_id` ASC),
    DROP INDEX `log_user_id_fk_idx` ;
;
ALTER TABLE `coregroup`.`logs`
    ADD CONSTRAINT `employee_id_fk`
        FOREIGN KEY (`employee_id`)
            REFERENCES `coregroup`.`employees` (`employee_id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;
ALTER TABLE `coregroup`.`messages`
    DROP FOREIGN KEY `sender_id_fk`,
    DROP FOREIGN KEY `recipient_id_fk`;
ALTER TABLE `coregroup`.`messages`
    CHANGE COLUMN `sender` `sender` VARCHAR(20) NOT NULL ,
    CHANGE COLUMN `recipient` `recipient` VARCHAR(20) NOT NULL ,
    DROP INDEX `recipient_id_fk` ,
    DROP INDEX `sender_id_fk` ;
UPDATE `coregroup`.`employees` SET `username` = 'newtonmusyimi', `password` = '$2y$10$JOLVeoPQGFmMJgl52d.vU.IemcsZNAha5MiOFra/o.n8LuVPbsxhq' WHERE (`employee_id` = '1');
INSERT INTO `coregroup`.`clients` (`client_id`, `first_name`, `last_name`, `email`, `mobile`, `address`, `username`, `password`)
VALUES ('1', 'Newton', 'Musyimi', 'newtonmusyimi@gmail.com', '0791411796', 'Grahamstown, Eastern Cape', 'clientnewton', '$2y$10$JOLVeoPQGFmMJgl52d.vU.IemcsZNAha5MiOFra/o.n8LuVPbsxhq');

--
ALTER TABLE `coregroup`.`messages` 
ADD COLUMN `wo_id` INT UNSIGNED NULL AFTER `type`;

ALTER TABLE `coregroup`.`messages` 
ADD CONSTRAINT `wo_id`
  FOREIGN KEY (`wo_id`)
  REFERENCES `coregroup`.`workorders` (`wo_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `coregroup`.`messages` 
DROP FOREIGN KEY `wo_id`;
ALTER TABLE `coregroup`.`messages` 
CHANGE COLUMN `wo_id` `wo_id` INT UNSIGNED NOT NULL ;
ALTER TABLE `coregroup`.`messages` 
ADD CONSTRAINT `wo_id`
  FOREIGN KEY (`wo_id`)
  REFERENCES `coregroup`.`workorders` (`wo_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

  ALTER TABLE `coregroup`.`employee_role` 
ADD INDEX `employee_id_idx` (`employee_id` ASC) VISIBLE;
;
ALTER TABLE `coregroup`.`employee_role` 
ADD CONSTRAINT `employee_id`
  FOREIGN KEY (`employee_id`)
  REFERENCES `coregroup`.`employees` (`employee_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
ALTER TABLE `coregroup`.`used_resources`
    DROP FOREIGN KEY `wo_id_resources_fk`,
    DROP FOREIGN KEY `asset_id_fk`;
ALTER TABLE `coregroup`.`used_resources`
    DROP INDEX `wo_id_fk_idx` ;
DROP TABLE `coregroup`.`used_resources`;

ALTER TABLE `coregroup`.`resources`
    ADD INDEX `resource_wo_id_idx` (`wo_id` ASC) VISIBLE;
;
ALTER TABLE `coregroup`.`resources`
    ADD CONSTRAINT `resource_wo_id`
        FOREIGN KEY (`wo_id`)
            REFERENCES `coregroup`.`workorders` (`wo_id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;
ALTER TABLE `coregroup`.`resources`
    DROP INDEX `wo_id_idx` ;

ALTER TABLE `coregroup`.`resources`
    ADD COLUMN `cost` DECIMAL(6,2) NOT NULL AFTER `wo_id`,
    ADD COLUMN `price` DECIMAL(6,2) NULL AFTER `cost`;

ALTER TABLE `coregroup`.`resources`
    DROP COLUMN `quantity`;

ALTER TABLE `coregroup`.`invoices`
    ADD COLUMN `wo_id` INT UNSIGNED NULL AFTER `amount`;

ALTER TABLE `coregroup`.`invoices`
    DROP FOREIGN KEY `quote_id_fk`;

ALTER TABLE `coregroup`.`invoices`
    ADD INDEX `invoice_wo_id_idx` (`wo_id` ASC) VISIBLE;
;
ALTER TABLE `coregroup`.`invoices`
    ADD CONSTRAINT `invoice_wo_id`
        FOREIGN KEY (`wo_id`)
            REFERENCES `coregroup`.`workorders` (`wo_id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;

ALTER TABLE `coregroup`.`invoices`
    DROP FOREIGN KEY `invoice_wo_id`;
ALTER TABLE `coregroup`.`invoices`
    CHANGE COLUMN `wo_id` `wo_id` INT UNSIGNED NOT NULL ;
ALTER TABLE `coregroup`.`invoices`
    ADD CONSTRAINT `invoice_wo_id`
        FOREIGN KEY (`wo_id`)
            REFERENCES `coregroup`.`workorders` (`wo_id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;

DROP TABLE `coregroup`.`quotes`;

-- 31-8-2022
ALTER TABLE `coregroup`.`invoices`
    ADD COLUMN `quote_status` TINYINT NOT NULL DEFAULT 0 AFTER `wo_id`;