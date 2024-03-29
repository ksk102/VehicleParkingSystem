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

/*20180912 added by kskoh*/
/* create transaction table */
CREATE TABLE IF NOT EXISTS transaction(
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  trans_user_id VARCHAR(255) NOT NULL,
  trans_active VARCHAR(255) NOT NULL,
  trans_start DATE NOT NULL,
  trans_starttime char(5),
  trans_end DATE,
  trans_endtime char(5),
  trans_loc INT(11) NOT NULL,
  trans_amount DECIMAL(10,2)
);

/*add user top up for top up request*/
ALTER TABLE users ADD COLUMN user_top_up DECIMAL(6,2);

/*eye rolling*/
ALTER TABLE location
CHANGE COLUMN id trans_loc_id INT(11);

ALTER TABLE transaction
CHANGE COLUMN trans_loc trans_loc_id INT(11);