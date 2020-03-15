CREATE DATABASE IF NOT EXISTS taskforce;
-- более верная схема базы данных
USE taskforce;

-- основные таблицы
-- родительская таблица 1
CREATE TABLE IF NOT EXISTS categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(60) NOT NULL,
  icon VARCHAR(60) NOT NULL
);
-- родительская таблица 2
CREATE TABLE IF NOT EXISTS cities (
  id INT AUTO_INCREMENT PRIMARY KEY,
  city_name VARCHAR(30) NOT NULL,
  lat INT NOT NULL,
  lng INT NOT NULL
);
-- родительская таблица 3
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(40) NOT NULL,
  email VARCHAR(128) NOT NULL,
  password VARCHAR(128) NOT NULL,
  created_at VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS user_profiles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  address TEXT,
  birthday VARCHAR(20),
  information TEXT,
  contact_phone VARCHAR(20),
  contact_skype VARCHAR(40),
  city_id INT,
  user_id INT
);

CREATE TABLE IF NOT EXISTS tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(60) NOT NULL,
  status VARCHAR(20) DEFAULT 'new',
  category_id INT NOT NULL,
  description TEXT,
  owner_user_id INT NOT NULL,
  performer_user_id INT,
  address TEXT,
  city_id INT,
  budget INT,
  created_at VARCHAR(20),
  date_close VARCHAR(20),
  lat INT,
  lng INT
);

CREATE TABLE IF NOT EXISTS reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  score INT NOT NULL,
  task_id INT NOT NULL,
  task_completed INT DEFAULT 0,
  performer_id INT NOT NULL,
  owner_id INT NOT NULL,
  message TEXT,
  created_at VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS responses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  price INT NOT NULL,
  user_id INT NOT NULL,
  task_id INT NOT NULL,
  `comment` TEXT NOT NULL,
  created_at VARCHAR(20)
);

-- дополнительные таблицы
CREATE TABLE IF NOT EXISTS favorite_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  favorite_user_id INT NOT NULL,
  current_user_id INT NOT NULL
);

CREATE TABLE IF NOT EXISTS notices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT NOT NULL,
  user_id INT NOT NULL,
  message TEXT NOT NULL,
  is_readed TINYINT DEFAULT 0,
  created_at VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS correspondence (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  message TEXT NOT NULL,
  created_at VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS photos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  link VARCHAR(256) NOT NULL,
  created_at VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS files (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT NOT NULL,
  link VARCHAR(256) NOT NULL
);

CREATE TABLE IF NOT EXISTS specializations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT NOT NULL,
  user_id INT NOT NULL
);

CREATE FULLTEXT INDEX username ON users(name);
CREATE FULLTEXT INDEX name ON tasks(name);
CREATE FULLTEXT INDEX description ON tasks(description);
