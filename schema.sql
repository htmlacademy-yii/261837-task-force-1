CREATE DATABASE IF NOT EXISTS taskforce;

USE taskforce;

CREATE TABLE IF NOT EXISTS categories (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(60) NOT NULL,
alias VARCHAR(60) NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
id INT AUTO_INCREMENT PRIMARY KEY,
nick VARCHAR(40) NOT NULL,
birtday TEXT NOT NULL,
email VARCHAR(128) NOT NULL,
password VARCHAR(128) NOT NULL,
avatar TEXT,
address TEXT,
info TEXT,
phone VARCHAR(15),
skype TEXT,
messenger TEXT,
is_account_hide TINYINT DEFAULT 0,
is_tasks_hide TINYINT DEFAULT 0,
);

CREATE TABLE IF NOT EXISTS tasks (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
status TINYINT DEFAULT 1,
name VARCHAR(50) NOT NULL,
description TEXT NOT NULL,
category_id INT NOT NULL,
files TEXT,
location VARCHAR(150),
price INT,
date_done CHAR(25)
);
