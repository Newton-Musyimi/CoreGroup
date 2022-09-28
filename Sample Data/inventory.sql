USE coregroup;
CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `products` (
  `product_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `product` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub-category` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `coregroup`.`orders` 
DROP FOREIGN KEY `order_wo_id_fk`;
ALTER TABLE `coregroup`.`orders` 
ADD COLUMN `product_id` INT UNSIGNED NOT NULL AFTER `order_id`,
CHANGE COLUMN `wo_id` `wo_id` INT(10) UNSIGNED NULL ,
ADD INDEX `order_product_id_idx` (`product_id` ASC);
;
ALTER TABLE `coregroup`.`orders` 
ADD CONSTRAINT `order_wo_id_fk`
  FOREIGN KEY (`wo_id`)
  REFERENCES `coregroup`.`workorders` (`wo_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `order_product_id`
  FOREIGN KEY (`product_id`)
  REFERENCES `coregroup`.`products` (`product_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

--

ALTER TABLE `coregroup`.`resources`
    ADD COLUMN `product_id` INT UNSIGNED NOT NULL AFTER `price`,
ADD INDEX `resources_product_id_idx` (`product_id` ASC) VISIBLE;
;
ALTER TABLE `coregroup`.`resources`
    ADD CONSTRAINT `resources_product_id`
        FOREIGN KEY (`product_id`)
            REFERENCES `coregroup`.`products` (`product_id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;

ALTER TABLE `coregroup`.`assigned_technicians`
    ADD COLUMN `normal_hours` DECIMAL(4,2) NULL AFTER `technician_comments`,
ADD COLUMN `overtime_hours` DECIMAL(4,2) NULL AFTER `normal_hours`;

ALTER TABLE `coregroup`.`products`
    ADD COLUMN `vendor` VARCHAR(200) NULL AFTER `sub-category`;

ALTER TABLE `coregroup`.`employees`
    ADD COLUMN `normal_pay` DECIMAL(6,2) NULL AFTER `password`,
ADD COLUMN `overtime_pay` DECIMAL(6,2) NULL AFTER `normal_pay`;

ALTER TABLE `coregroup`.`employees`
    CHANGE COLUMN `username` `username` VARCHAR(20) NULL ;


