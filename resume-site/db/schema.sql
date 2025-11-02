CREATE DATABASE IF NOT EXISTS resume_db;
USE resume_db;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  lastname VARCHAR(255),
  firstname VARCHAR(255),
  email VARCHAR(255),
  phone VARCHAR(50),
  picture VARCHAR(255)
);

CREATE TABLE experiences (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  name VARCHAR(255),
  description VARCHAR(1000),
  startdate DATE,
  enddate DATE,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE educations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  name VARCHAR(255),
  description VARCHAR(1000),
  startdate DATE,
  enddate DATE,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE skills (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  name VARCHAR(255),
  level VARCHAR(50),
  FOREIGN KEY (user_id) REFERENCES users(id)
);