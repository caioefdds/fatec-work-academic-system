CREATE SCHEMA `project` ;

CREATE TABLE `project`.`course` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `period` VARCHAR(45) NULL,
  `description` VARCHAR(100) NULL,
  PRIMARY KEY (`id`));
  
  CREATE TABLE `project`.`subject` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `workload` INT NULL,
  `course_id` INT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `project`.`professor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `titration` INT NULL,
  PRIMARY KEY (`id`));
  W
  CREATE TABLE `project`.`class` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `course_id` INT NULL,
  `description` VARCHAR(100) NULL,
  PRIMARY KEY (`id`));
  
  CREATE TABLE `project`.`student` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `class_id` INT NULL,
  PRIMARY KEY (`id`));