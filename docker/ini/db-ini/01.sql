CREATE DATABASE IF NOT EXISTS zimalab_test;
USE zimalab_test;
CREATE TABLE IF NOT EXISTS customers (id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY (id),
first_name VARCHAR(30) NOT NULL,
last_name VARCHAR(30) NOT NULL,
email VARCHAR(100) NOT NULL,
company_name VARCHAR(100),
position VARCHAR(100),
phone_number VARCHAR(10),
UNIQUE (id,email));