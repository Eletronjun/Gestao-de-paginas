DROP DATABASE IF EXISTS eletronjun_db;
CREATE DATABASE eletronjun_db;

USE eletronjun_db;

CREATE USER 'tp'@'localhost' IDENTIFIED BY "1234";
GRANT ALL PRIVILEGES ON *.* TO  'tp'@'localhost';


