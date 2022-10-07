-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: coregroup
-- Source Schemata: coregroup
-- Created: Fri Oct  7 12:54:43 2022
-- Workbench Version: 8.0.29
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema coregroup
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `coregroup` ;
CREATE SCHEMA IF NOT EXISTS `coregroup` ;

-- ----------------------------------------------------------------------------
-- Table coregroup.assigned_technicians
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`assigned_technicians` (
  `wo_id` INT UNSIGNED NOT NULL,
  `employee_id` INT UNSIGNED NOT NULL,
  `technician_comments` TEXT NULL DEFAULT NULL,
  `normal_hours` DECIMAL(4,2) NULL DEFAULT NULL,
  `overtime_hours` DECIMAL(4,2) NULL DEFAULT NULL,
  INDEX `wo_id_assigned_fk_idx` (`wo_id` ASC) VISIBLE,
  INDEX `employee_id_assigned_fk_idx` (`employee_id` ASC) VISIBLE,
  CONSTRAINT `employee_id_assigned_fk`
    FOREIGN KEY (`employee_id`)
    REFERENCES `coregroup`.`employees` (`employee_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `wo_id_assigned_fk`
    FOREIGN KEY (`wo_id`)
    REFERENCES `coregroup`.`workorders` (`wo_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.clients
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`clients` (
  `client_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(20) NOT NULL,
  `last_name` VARCHAR(20) NOT NULL,
  `email` VARCHAR(254) NOT NULL,
  `mobile` VARCHAR(14) NOT NULL,
  `address` TEXT NOT NULL,
  `username` VARCHAR(20) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `profile_picture` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `phone_UNIQUE` (`mobile` ASC) VISIBLE,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 41
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.devices
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`devices` (
  `device_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `owner_id` INT UNSIGNED NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `category` VARCHAR(10) NOT NULL,
  `brand` VARCHAR(10) NOT NULL,
  `model` VARCHAR(20) NULL DEFAULT NULL,
  `serial_number` BIGINT NULL DEFAULT NULL,
  `location` VARCHAR(50) NULL DEFAULT NULL,
  `device_name` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`device_id`),
  INDEX `owner_id_fk_idx` (`owner_id` ASC) VISIBLE,
  CONSTRAINT `owner_id_fk`
    FOREIGN KEY (`owner_id`)
    REFERENCES `coregroup`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 24
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.documents
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`documents` (
  `document_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `device_id` INT UNSIGNED NULL DEFAULT NULL,
  `uploaded_by` VARCHAR(20) NULL DEFAULT NULL,
  `file_path` VARCHAR(200) NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `description` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`document_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.employee_role
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`employee_role` (
  `employee_id` INT UNSIGNED NOT NULL,
  `role_id` INT UNSIGNED NOT NULL,
  INDEX `role_id` (`role_id` ASC) VISIBLE,
  INDEX `employee_id_idx` (`employee_id` ASC) VISIBLE,
  CONSTRAINT `employee_id`
    FOREIGN KEY (`employee_id`)
    REFERENCES `coregroup`.`employees` (`employee_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `employee_role_ibfk_2`
    FOREIGN KEY (`role_id`)
    REFERENCES `coregroup`.`roles` (`role_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.employees
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`employees` (
  `employee_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(20) NOT NULL,
  `last_name` VARCHAR(20) NOT NULL,
  `email` VARCHAR(254) NOT NULL,
  `title` VARCHAR(15) NOT NULL,
  `mobile` VARCHAR(14) NOT NULL,
  `address` TEXT NULL DEFAULT NULL,
  `username` VARCHAR(20) NULL DEFAULT NULL,
  `password` VARCHAR(60) NULL DEFAULT NULL,
  `normal_pay` DECIMAL(6,2) NULL DEFAULT NULL,
  `overtime_pay` DECIMAL(6,2) NULL DEFAULT NULL,
  `profile_picture` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  UNIQUE INDEX `mobile_UNIQUE` (`mobile` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 22
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.invoices
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`invoices` (
  `invoice_id` INT UNSIGNED NOT NULL,
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` TINYINT NOT NULL DEFAULT '0',
  `amount` DECIMAL(6,2) NOT NULL,
  `wo_id` INT UNSIGNED NOT NULL,
  `quote_status` TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY (`invoice_id`),
  INDEX `invoice_wo_id_idx` (`wo_id` ASC) VISIBLE,
  CONSTRAINT `invoice_wo_id`
    FOREIGN KEY (`wo_id`)
    REFERENCES `coregroup`.`workorders` (`wo_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.messages
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`messages` (
  `message_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender` VARCHAR(200) NOT NULL,
  `recipient` VARCHAR(20) NOT NULL,
  `message` TEXT NOT NULL,
  `datetime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` VARCHAR(20) NOT NULL,
  `wo_id` INT UNSIGNED NULL DEFAULT NULL,
  `previous_message_id` INT UNSIGNED NULL DEFAULT NULL,
  `title` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`message_id`),
  INDEX `wo_id_fk_idx` (`wo_id` ASC) VISIBLE,
  CONSTRAINT `wo_id`
    FOREIGN KEY (`wo_id`)
    REFERENCES `coregroup`.`workorders` (`wo_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 25
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.orders
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`orders` (
  `order_id` INT NOT NULL AUTO_INCREMENT,
  `product_id` INT UNSIGNED NOT NULL,
  `ordered_by` INT UNSIGNED NOT NULL,
  `date_ordered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wo_id` INT UNSIGNED NULL DEFAULT NULL,
  `quantity` INT NOT NULL,
  `cost` DECIMAL(6,2) NULL DEFAULT NULL,
  `order_status` TINYINT NOT NULL DEFAULT '0',
  `date_collected` TIMESTAMP NULL DEFAULT NULL,
  `collected` TINYINT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`),
  INDEX `ordered_by_fk_idx` (`ordered_by` ASC) VISIBLE,
  INDEX `order_wo_id_fk_idx` (`wo_id` ASC) VISIBLE,
  INDEX `order_product_id_idx` (`product_id` ASC) VISIBLE,
  CONSTRAINT `order_wo_id_fk`
    FOREIGN KEY (`wo_id`)
    REFERENCES `coregroup`.`workorders` (`wo_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `ordered_by_fk`
    FOREIGN KEY (`ordered_by`)
    REFERENCES `coregroup`.`employees` (`employee_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.products
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`products` (
  `product_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `product` VARCHAR(45) CHARACTER SET 'utf8mb4' NOT NULL,
  `category` VARCHAR(45) CHARACTER SET 'utf8mb4' NOT NULL,
  `sub-category` VARCHAR(45) CHARACTER SET 'utf8mb4' NOT NULL,
  `vendor` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.resources
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`resources` (
  `asset_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` TEXT NOT NULL,
  `location` VARCHAR(20) NULL DEFAULT NULL,
  `wo_id` INT UNSIGNED NULL DEFAULT NULL,
  `cost` DECIMAL(6,2) NOT NULL,
  `price` DECIMAL(6,2) NULL DEFAULT NULL,
  `product_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`asset_id`),
  INDEX `resource_wo_id_idx` (`wo_id` ASC) VISIBLE,
  INDEX `resources_product_id_idx` (`product_id` ASC) VISIBLE,
  CONSTRAINT `resource_wo_id`
    FOREIGN KEY (`wo_id`)
    REFERENCES `coregroup`.`workorders` (`wo_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `resources_product_id`
    FOREIGN KEY (`product_id`)
    REFERENCES `coregroup`.`products` (`product_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.roles
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`roles` (
  `role_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE INDEX `role_name_UNIQUE` (`role_name` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.users
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`users` (
  `username` VARCHAR(20) NOT NULL,
  `table` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`username`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table coregroup.workorders
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coregroup`.`workorders` (
  `wo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(11) NOT NULL DEFAULT 'pending',
  `priority` VARCHAR(7) NULL DEFAULT NULL,
  `requested_by` VARCHAR(20) NOT NULL,
  `client_id` INT UNSIGNED NULL DEFAULT NULL,
  `request_type` VARCHAR(11) NOT NULL,
  `dropoff_date` TIMESTAMP NOT NULL,
  `date_started` TIMESTAMP NULL DEFAULT NULL,
  `date_completed` TIMESTAMP NULL DEFAULT NULL,
  `dispatch_method` VARCHAR(10) NOT NULL,
  `dispatch_status` TINYINT NULL DEFAULT '0',
  `dispatch_date` TIMESTAMP NULL DEFAULT NULL,
  `device_id` INT UNSIGNED NOT NULL,
  `client_comments` TEXT NULL DEFAULT NULL,
  `title` VARCHAR(200) NULL DEFAULT NULL,
  `description` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`wo_id`),
  INDEX `clientid_fk_idx` (`client_id` ASC) VISIBLE,
  INDEX `deviceid_fk_idx` (`device_id` ASC) VISIBLE,
  CONSTRAINT `clientid_fk`
    FOREIGN KEY (`client_id`)
    REFERENCES `coregroup`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `deviceid_fk`
    FOREIGN KEY (`device_id`)
    REFERENCES `coregroup`.`devices` (`device_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 23
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;
SET FOREIGN_KEY_CHECKS = 1;
