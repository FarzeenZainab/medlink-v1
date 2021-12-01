DROP DATABASE IF EXISTS `medlink`;

CREATE DATABASE `medlink`;
USE `medlink`;

-- users table
DROP TABLE IF EXISTS users;
CREATE TABLE users (
	user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    age INT NOT NULL,
    date_of_birth DATE,
    email VARCHAR(200) NOT NULL UNIQUE,
    password VARCHAR(200) NOT NULL,
    contact_number VARCHAR(100) NOT NULL,
    gender VARCHAR(10)
);

-- medicine table
DROP TABLE IF EXISTS medicines;
CREATE TABLE medicines (
	med_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    med_name VARCHAR(250) NOT NULL,
    strength VARCHAR(100),
    added_on_date date
);

-- doses table
DROP TABLE IF EXISTS doses;
CREATE TABLE doses(
	dose_id INT PRIMARY KEY AUTO_INCREMENT,
	dose INT NOT NULL DEFAULT 1,
    med_id INT NOT NULL,
    user_id INT NOT NULL,
    `date` DATE NOT NULL,
	time_to_take_at TIME NOT NULL, -- HH:MM:SS uses 24 hours format
    frequency int NOT NULL,
    remind_at_date date NOT NULL,
    remind_at_time time NOT NULL,
    FOREIGN KEY(med_id) REFERENCES medicines(med_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

-- status table
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
	status_id INT PRIMARY KEY AUTO_INCREMENT,
    `status` VARCHAR(25) DEFAULT 'pending'
);

-- type table
DROP TABLE IF EXISTS med_type;
CREATE TABLE med_type (
	type_id INT PRIMARY KEY AUTO_INCREMENT,
    `type` VARCHAR(30)
);

ALTER TABLE doses ADD COLUMN status_id INT NOT NULL DEFAULT 3;
ALTER TABLE doses ADD FOREIGN KEY(status_id) REFERENCES `status`(status_id) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE medicines ADD COLUMN type_id INT NOT NULL;
ALTER TABLE medicines ADD FOREIGN KEY(type_id) REFERENCES med_type(type_id) ON UPDATE CASCADE ON DELETE CASCADE;

INSERT INTO `status`(`status`) VALUES('taken'), ('skipped'), ('pending');

USE medlink;

-- medicine types
INSERT INTO med_type(`type`) VALUES('pill'), ('capsule'), ('liquid'), ('drops'), ('inhaler'), ('injection'), ('tablet');

-- user medical history
DROP TABLE IF EXISTS user_medical_history;
CREATE TABLE user_medical_history(
	h_id INT PRIMARY KEY AUTO_INCREMENT,
	dose_id INT,
	dose_quantity INT NOT NULL DEFAULT 1,
    med_id INT NOT NULL,
    user_id INT NOT NULL,
    `date` DATE NOT NULL,
	time_to_take_at TIME NOT NULL, -- HH:MM:SS uses 24 hours format
    frequency int NOT NULL,
    status_id INT,
    action_datetime datetime default current_timestamp(),
    action VARCHAR(100) NOT NULL
);

-- doses deleted
-- we are storing the data of a deleted row inside a table which is not related to any tables
-- in the database. The reason of doing this is because view is not able to find the deleted row
-- to show on history page. We have to store the data before deletion so we can show
-- the user the data of the deleted dose

DROP TABLE IF EXISTS deleted_doses;
CREATE TABLE deleted_doses
(
	id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT NOT NULL,
    med_id INT NOT NULL,
    date date  NOT NULL,  
    time_to_take_at time  NOT NULL,
    status_id INT NOT NULL,
    action_datetime datetime default current_timestamp()  NOT NULL,
    action VARCHAR(100) NOT NULL
)






















