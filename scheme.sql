DROP DATABASE IF EXISTS taskforce;

CREATE DATABASE taskforce
	DEFAULT CHARACTER SET utf8;

USE taskforce;

CREATE TABLE city (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  title VARCHAR(255) NOT NULL
);

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  registration DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  name VARCHAR(128) NOT NULL,
  email VARCHAR(128) NOT NULL UNIQUE,
  city_id INT NOT NULL,
  password CHAR(255) NOT NULL,
  role_id INT NOT NULL,
  FOREIGN KEY (city_id) REFERENCES cities(id),
  FOREIGN KEY (role_id) REFERENCES roles(id)
);
CREATE TABLE category (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  code VARCHAR(128) NOT NULL UNIQUE,
  title VARCHAR(128) NOT NULL
);
CREATE TABLE task (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  estimate INT NOT NULL,
  runtime DATE NOT NULL,
  city_id INT NOT NULL,
  location VARCHAR(255) NOT NULL,
  user_id INT NOT NULL,
  executor_id INT NOT NULL,
  category_id INT NOT NULL,
  task_status VARCHAR(128) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id),
  FOREIGN KEY (city_id) REFERENCES cities(id)
);
CREATE TABLE attachment (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  task_id INT NOT NULL,
  path VARCHAR(255) NOT NULL,
  FOREIGN KEY (task_id) REFERENCES tasks(id)
);
CREATE TABLE executor (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  user_id INT NOT NULL,
  avatar VARCHAR(255),
  birthday DATE,
  phone VARCHAR(128) UNIQUE,
  rating INT,
  specialty VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE response (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  task_id INT NOT NULL,
  executor_id INT NOT NULL,
  price INT NOT NULL,
  comment TEXT,
  FOREIGN KEY (task_id) REFERENCES tasks(id),
  FOREIGN KEY (executor_id) REFERENCES executors(id)
);
CREATE TABLE review (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  user_id INT NOT NULL,
  task_id INT NOT NULL,
  executor_id INT NOT NULL,
  comment TEXT NOT NULL,
  stats INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (task_id) REFERENCES tasks(id),
  FOREIGN KEY (executor_id) REFERENCES executors(id)
);
  