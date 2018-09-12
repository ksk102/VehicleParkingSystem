/*create db*/
CREATE DATABASE IF NOT EXISTS parkmelaka;
USE parkmelaka;

/*create users table*/
CREATE TABLE IF NOT EXISTS users(
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  user_email VARCHAR(255) NOT NULL,
  user_password VARCHAR(255) NOT NULL,
  user_name VARCHAR(255),
  user_balance DECIMAL(6,2) NOT NULL
);

/*insert dummy data into users table*/
DELETE FROM users;
INSERT INTO users (user_email, user_password, user_name, user_balance)
VALUES ("kahsiang95@hotmail.com", "123456", "KS Koh", 0.00);

/*add plate_number field to the users table*/
ALTER TABLE users ADD COLUMN car_plate_number VARCHAR(10);


/*20180911 added by kskoh*/
/* create location table */
CREATE TABLE IF NOT EXISTS location(
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  loc_name VARCHAR(255) NOT NULL,
  loc_council VARCHAR(255) NOT NULL,
  loc_state VARCHAR(255)
);

/* insert data into location table */
INSERT INTO location (loc_name, loc_council, loc_state)
VALUES ("Bukit Beruang", "MPHTJ", "Melaka"),
       ("Batu Berendam", "MPHTJ", "Melaka"),
       ("Melaka Raya", "MBMB", "Melaka"),
       ("Kota Laksamana", "MBMB", "Melaka"),
       ("Bukit Baru", "MPHTJ", "Melaka");

INSERT INTO users (user_email, user_password, user_name, user_balance, car_plate_number)
VALUES ("q", "q", "Koh Kah Siang", 101.60, "JMM5199");