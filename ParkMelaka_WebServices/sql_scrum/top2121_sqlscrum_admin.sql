/*create db*/
CREATE DATABASE IF NOT EXISTS parkmelaka_admin;
USE parkmelaka_admin;

/*create admin table*/
CREATE TABLE IF NOT EXISTS admin(
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  admin_ID VARCHAR(255) NOT NULL,
  admin_password VARCHAR(255) NOT NULL,
  admin_name VARCHAR(255)
);

/*insert dummy data into admin table*/
DELETE FROM admin;
INSERT INTO admin (admin_ID, admin_password, admin_name)
VALUES ("1121100123", "123456", "KS Koh");