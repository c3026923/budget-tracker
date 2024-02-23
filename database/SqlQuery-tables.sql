DROP TABLE IF EXISTS expense_transaction;
DROP TABLE IF EXISTS income_transaction;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS department;
DROP TABLE IF EXISTS net_income;
DROP TABLE IF EXISTS budget;

CREATE TABLE `budget` (
  `budget_id` int unsigned auto_increment NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` float,
  PRIMARY KEY (`budget_id`)
);

CREATE TABLE `net_income` (
  `net_inc_id` int unsigned auto_increment NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` float,
  PRIMARY KEY (`net_inc_id`)
);

CREATE TABLE `department` (
  `department_id` int unsigned auto_increment NOT NULL,
  `budget_id` int unsigned NOT NULL,
  `net_inc_id` int unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `address_1` varchar(50) NOT NULL,
  `address_2` varchar(50) NOT NULL,
  `address_3` varchar(50) DEFAULT NULL,
  `address_4` varchar(50) DEFAULT NULL,
  `postcode` varchar(10) NOT NULL,
  PRIMARY KEY (`department_id`),
  FOREIGN KEY (`budget_id`) REFERENCES budget (`budget_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`net_inc_id`) REFERENCES net_income (`net_inc_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `user` (
  `user_id` int auto_increment NOT NULL,
  `department_id` int unsigned NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `employee_type` int NOT NULL,
  `locked` boolean NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  FOREIGN KEY (`department_id`) REFERENCES department (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `income_transaction` (
  `income_id` int unsigned auto_increment NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `info` varchar(100) NOT NULL,
  `value` float NOT NULL,
  PRIMARY KEY (`income_id`),
  FOREIGN KEY (`user_id`) REFERENCES user (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `expense_transaction` (
  `expense_id` int auto_increment NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `info` varchar(100) NOT NULL,
  `value` float NOT NULL,
  PRIMARY KEY (`expense_id`),
  FOREIGN KEY (`user_id`) REFERENCES user (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);