DROP DATABASE IF EXISTS taskforce;

CREATE DATABASE taskforce
	DEFAULT CHARACTER SET utf8;

USE taskforce;

CREATE TABLE cities (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255)
);
CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(128)
);
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  registration DATETIME DEFAULT CURRENT_TIMESTAMP,
  name VARCHAR(128),
  email VARCHAR(128) NOT NULL UNIQUE,
  city_id INT,
  password CHAR(255),
  role_id INT,
  FOREIGN KEY (city_id) REFERENCES cities(id),
  FOREIGN KEY (role_id) REFERENCES roles(id)
);
CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(128) UNIQUE,
  title VARCHAR(128)
);
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  creation DATETIME DEFAULT CURRENT_TIMESTAMP,
  title VARCHAR(255),
  description TEXT,
  estimate INT,
  runtime DATE,
  city_id INT,
  location VARCHAR(255),
  user_id INT,
  executor_id INT,
  category_id INT,
  task_status VARCHAR(128),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id),
  FOREIGN KEY (city_id) REFERENCES cities(id)
);
CREATE TABLE files (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT,
  path VARCHAR(255),
  FOREIGN KEY (task_id) REFERENCES tasks(id)
);
CREATE TABLE executors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  avatar VARCHAR(255),
  birthday DATE,
  phone VARCHAR(128),
  feedback VARCHAR(128),
  info TEXT,
  current_status VARCHAR(128),
  compleded_tasks INT,
  failed_tasks INT,
  rating INT,
  specialty VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE response (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT,
  executor_id INT,
  price INT,
  comment TEXT,
  FOREIGN KEY (task_id) REFERENCES tasks(id),
  FOREIGN KEY (executor_id) REFERENCES executors(id)
);
CREATE TABLE reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  task_id INT,
  executor_id INT,
  comment TEXT,
  stats INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (task_id) REFERENCES tasks(id),
  FOREIGN KEY (executor_id) REFERENCES executors(id)
);
  