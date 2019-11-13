CREATE DATABASE IF NOT EXISTS taskforce;

USE taskforce;

-- родительская таблица 1
CREATE TABLE IF NOT EXISTS categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(60) NOT NULL,
  alias VARCHAR(60) NOT NULL
);

CREATE TABLE IF NOT EXISTS specializations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT NOT NULL,
  executor_id INT NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(40) NOT NULL,
  email VARCHAR(128) NOT NULL,
  hash_password VARCHAR(128) NOT NULL,
  city_id INT NOT NULL,
  created_at INT NOT NULL,
  birtday INT,
  avatar TEXT,
  address TEXT,
  info TEXT,
  phone VARCHAR(15),
  skype VARCHAR(60),
  messenger VARCHAR(60),
  is_account_hide TINYINT DEFAULT 0,
  is_tasks_hide TINYINT DEFAULT 0,
  is_email_allowed TINYINT DEFAULT 0,
  last_active INT
);

CREATE TABLE IF NOT EXISTS favorite_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  favorite_user_id INT NOT NULL,
  current_user_id INT NOT NULL
);

-- родительская таблица 2
CREATE TABLE IF NOT EXISTS cities (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  lat INT NOT NULL,
  lon INT NOT NULL
);

CREATE TABLE IF NOT EXISTS reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vote TINYINT NOT NULL,
  author_id INT NOT NULL,
  user_id INT NOT NULL,
  message TEXT NOT NULL,
  created_at INT
);

CREATE TABLE IF NOT EXISTS responces (
  id INT AUTO_INCREMENT PRIMARY KEY,
  budget INT NOT NULL,
  author_id INT NOT NULL,
  task_id INT NOT NULL,
  message TEXT NOT NULL,
  is_rejected TINYINT DEFAULT 0,
  is_approved TINYINT DEFAULT 0,
  created_at INT
);

CREATE TABLE IF NOT EXISTS notices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT NOT NULL,
  user_id INT NOT NULL,
  message TEXT NOT NULL,
  is_readed TINYINT DEFAULT 0,
  created_at INT
);

CREATE TABLE IF NOT EXISTS correspondence (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  message TEXT NOT NULL,
  created_at INT
);

CREATE TABLE IF NOT EXISTS photos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  link VARCHAR(256) NOT NULL,
  created_at INT
);

CREATE TABLE IF NOT EXISTS tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  status TINYINT DEFAULT 1,
  name VARCHAR(50) NOT NULL,
  description TEXT NOT NULL,
  category_id INT NOT NULL,
  executer_id INT,
  address TEXT,
  expire INT,
  city_id INT,
  budget INT,
  created_at INT
);

CREATE TABLE IF NOT EXISTS files (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT NOT NULL,
  link VARCHAR(256) NOT NULL
);

CREATE UNIQUE INDEX email ON users(email);
CREATE FULLTEXT INDEX username ON users(username);
CREATE FULLTEXT INDEX name ON tasks(name);
ALTER TABLE specializations
  ADD FOREIGN KEY fk_s_category_id (category_id)
  REFERENCES users (id)
  ON DELETE CASCADE;
ALTER TABLE specializations
  ADD FOREIGN KEY fk_s_executor_id (executor_id)
  REFERENCES categories (id)
  ON DELETE CASCADE;
ALTER TABLE favorite_users
  ADD FOREIGN KEY fk_fu_fav_user_id (favorite_user_id)
  REFERENCES users (id)
  ON DELETE CASCADE;
ALTER TABLE favorite_users
  ADD FOREIGN KEY fk_fu_current_user_id (current_user_id)
  REFERENCES users (id)
  ON DELETE CASCADE;
ALTER TABLE tasks
  ADD FOREIGN KEY fk_t_category_id (category_id)
  REFERENCES categories (id)
  ON DELETE CASCADE;
ALTER TABLE tasks
  ADD FOREIGN KEY fk_t_user_id (user_id)
  REFERENCES users (id)
  ON DELETE CASCADE;
ALTER TABLE tasks
  ADD FOREIGN KEY fk_t_executer_id (executer_id)
  REFERENCES users (id)
  ON DELETE CASCADE;
ALTER TABLE tasks
  ADD FOREIGN KEY fk_t_city_id (city_id)
  REFERENCES cities (id)
  ON DELETE CASCADE;
ALTER TABLE files
  ADD FOREIGN KEY fk_f_file_id (task_id)
  REFERENCES tasks (id)
  ON DELETE CASCADE;
ALTER TABLE reviews
  ADD FOREIGN KEY fk_r_author_id (author_id)
  REFERENCES users (id)
  ON DELETE CASCADE;
ALTER TABLE reviews
  ADD FOREIGN KEY fk_r_user_id (user_id)
  REFERENCES users (id)
  ON DELETE CASCADE;
ALTER TABLE users
  ADD FOREIGN KEY fk_u_city_id (city_id)
  REFERENCES cities (id)
  ON DELETE CASCADE;
ALTER TABLE responces
  ADD FOREIGN KEY fk_res_author_id (author_id)
  REFERENCES users (id)
  ON DELETE CASCADE;
ALTER TABLE responces
  ADD FOREIGN KEY fk_res_task_id (task_id)
  REFERENCES tasks (id)
  ON DELETE CASCADE;
ALTER TABLE notices
  ADD FOREIGN KEY fk_n_user_id (user_id)
  REFERENCES users (id)
  ON DELETE CASCADE;
ALTER TABLE notices
  ADD FOREIGN KEY fk_n_task_id (task_id)
  REFERENCES tasks (id)
  ON DELETE CASCADE;
ALTER TABLE correspondence
  ADD FOREIGN KEY fk_cor_city_id (user_id)
  REFERENCES users (id)
  ON DELETE CASCADE;
ALTER TABLE photos
  ADD FOREIGN KEY fk_ph_user_id (user_id)
  REFERENCES users (id)
  ON DELETE CASCADE;
