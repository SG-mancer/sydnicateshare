
DROP DATABASE IF EXISTS SYNDICATE1;
CREATE DATABASE IF NOT EXISTS `SYNDICATE1`;
USE `SYNDICATE1`;

-- ACCOUNT records the number of shares of each member
-- 0 shares is used for non-share holding accounts (i.e. maintenance or auditing logins)
CREATE TABLE `Account` (
    `account_no` INT AUTO_INCREMENT,
    `account_name` VARCHAR(32) NOT NULL,
    `account_shares` INT NOT NULL CHECK(account_shares >= 0),
    `active` BOOLEAN NOT NULL,
    PRIMARY KEY(`ACCOUNT_NO`)
);

-- SYNDICATE_USERs are webpage logins, each is associated with an account
-- NOTE: USERNAME, PASSWORD AND CONTACT_NO are all hashed for security
CREATE TABLE `Syndicate_User` (
    `account_no` INT NOT NULL,
    `username` VARCHAR(32) UNIQUE,
    `password` VARCHAR(32),
    `contact_no` VARCHAR(32),
    PRIMARY KEY(`USERNAME`)
);

-- COSTS are expenses paid for my account holders i.e. repairs paid for out of pocket
CREATE TABLE `Costs` (
    `lodged` DATETIME UNIQUE,
    `date` DATE NOT NULL,
    `account_no` INT NOT NULL,
    `ammount` DECIMAL(10,2) NOT NULL,
    `note` TEXT(256),
    `image` VARCHAR(32),
    `verified` BOOLEAN,
    PRIMARY KEY(`lodged`)
);

-- EXPENSES are expenses invoiced to the vessel, and paid from joint funds
CREATE TABLE `Expenses` (
    `lodged` DATETIME UNIQUE,
    `due_date` DATE NOT NULL,
    `ammount` DECIMAL(10,2) NOT NULL,
    `note` TEXT(256),
    `image` VARCHAR(32),
    `paid` BOOLEAN,
    `date_paid` DATE,
    PRIMARY KEY(`lodged`)
);

-- MAINTENANCE_REQUESTs are for recording defects and items that need attention 
CREATE TABLE `Maintenance_Request` (
    `request_no` INT AUTO_INCREMENT,
    `account_no` INT NOT NULL,
    `safety_issue` BOOLEAN,
    `title` VARCHAR(128),
    `description` TEXT(512),
    `image` VARCHAR(32),
    PRIMARY KEY(`request_no`)
);

-- log of maintenance as it is conducted
CREATE TABLE `Maintenace_Log` (
    `log_no` INT AUTO_INCREMENT,
    `request_no` INT,
    `notes` TEXT(512),
    `image` VARCHAR(32),
    `account_no` INT NOT NULL,
    `closed` BOOLEAN,
    `updated` DATETIME,
    PRIMARY KEY(`log_no`)
);

CREATE TABLE `Bookings` (
    `booking_no` INT AUTO_INCREMENT,
    `account_no` INT NOT NULL,
    `from_date` DATE NOT NULL,
    `to_date` DATE NOT NULL CHECK(to_date >= from_date),
    `notes` TEXT(256),
    PRIMARY KEY(`booking_no`)
);

