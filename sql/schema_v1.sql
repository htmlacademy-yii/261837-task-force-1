-- более верная схема базы данных

-- основные таблицы
-- родительская таблица 1
DROP TABLE IF EXISTS categories;

CREATE TABLE IF NOT EXISTS categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(60) NOT NULL,
  icon VARCHAR(60) NOT NULL
);
-- родительская таблица 2

DROP TABLE IF EXISTS cities;

CREATE TABLE IF NOT EXISTS cities (
  id INT AUTO_INCREMENT PRIMARY KEY,
  city_name VARCHAR(30) NOT NULL,
  lat INT NOT NULL,
  lng INT NOT NULL
);
-- родительская таблица 3

DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(40) NOT NULL,
  email VARCHAR(128) NOT NULL,
  password VARCHAR(128) NOT NULL,
  created_at VARCHAR(20) NOT NULL
);

DROP TABLE IF EXISTS user_profiles;

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

DROP TABLE IF EXISTS tasks;

CREATE TABLE IF NOT EXISTS tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(60) NOT NULL,
  status VARCHAR(20) DEFAULT 'new',
  category_id INT NOT NULL,
  description TEXT,
  owner_user_id INT NOT NULL,
  performer_user_id INT NOT NULL,
  address TEXT,
  city_id INT,
  budget INT,
  created_at VARCHAR(20),
  date_close VARCHAR(20),
  lat INT,
  lng INT
);

DROP TABLE IF EXISTS reviews;

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

DROP TABLE IF EXISTS responses;

CREATE TABLE IF NOT EXISTS responses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  price INT NOT NULL,
  user_id INT NOT NULL,
  task_id INT NOT NULL,
  `comment` TEXT NOT NULL,
  created_at VARCHAR(20)
);

-- дополнительные таблицы
DROP TABLE IF EXISTS favorite_users;

CREATE TABLE IF NOT EXISTS favorite_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  favorite_user_id INT NOT NULL,
  current_user_id INT NOT NULL
);

DROP TABLE IF EXISTS notices;

CREATE TABLE IF NOT EXISTS notices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT NOT NULL,
  user_id INT NOT NULL,
  message TEXT NOT NULL,
  is_readed TINYINT DEFAULT 0,
  created_at VARCHAR(20)
);

DROP TABLE IF EXISTS correspondence;

CREATE TABLE IF NOT EXISTS correspondence (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  message TEXT NOT NULL,
  created_at VARCHAR(20)
);

DROP TABLE IF EXISTS photos;

CREATE TABLE IF NOT EXISTS photos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  link VARCHAR(256) NOT NULL,
  created_at VARCHAR(20)
);

DROP TABLE IF EXISTS files;

CREATE TABLE IF NOT EXISTS files (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT NOT NULL,
  link VARCHAR(256) NOT NULL
);

DROP TABLE IF EXISTS specializations;

CREATE TABLE IF NOT EXISTS specializations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT NOT NULL,
  user_id INT NOT NULL
);

CREATE FULLTEXT INDEX username ON users(name);
CREATE FULLTEXT INDEX name ON tasks(name);
CREATE FULLTEXT INDEX description ON tasks(description);
