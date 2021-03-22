/* create the database */
CREATE DATABASE cruddb;
/* create users tables */
CREATE TABLE `uyhwildh_crudb`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `created_at` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
