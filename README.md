# 95882WebDevelopment
For 95882 Course Project

mysql database configure:

create table goods(
id INT NOT NULL AUTO_INCREMENT,
good_name VARCHAR(100) NOT NULL,
supermarket VARCHAR(100) NOT NULL,
price DOUBLE NOT NULL,
description VARCHAR(255),
tag VARCHAR(100) DEFAULT NULL,
promote INT DEFAULT 0,
PRIMARY KEY ( id )
);

create table users (
user_id INT NOT NULL AUTO_INCREMENT,
user_name VARCHAR(30) NOT NULL,
password CHAR(40) NOT NULL,
registration_date DATETIME NOT NULL,
PRIMARY KEY (user_id)
);

create table privatelike (
good_id INT NOT NULL,
good_name VARCHAR(100) NOT NULL,
supermarket VARCHAR(100) NOT NULL,
price DOUBLE NOT NULL,
description VARCHAR(255),
user_account VARCHAR(100) NOT NULL
)
