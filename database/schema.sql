-- TeenVitality database schema
-- Run this once to set up the database used by the whole site.
-- (Replaces the previous logins.sql / sign.sql / users_system.sql /
--  contact_messages.sql / "CREATE TABLE users (.sql" files, which
--  defined three different, conflicting databases.)

CREATE DATABASE IF NOT EXISTS teenvitality;
USE teenvitality;

-- Used by: index.html (registration form) -> connect1.php
--          login.html  (login form)       -> login.php
--          login.html  ("Sign up here")   -> form.php
CREATE TABLE IF NOT EXISTS users (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(100) NOT NULL,
    email         VARCHAR(150) NOT NULL UNIQUE,
    mobile_number VARCHAR(20)  NOT NULL,
    user_id       VARCHAR(50)  NOT NULL UNIQUE,
    password      VARCHAR(255) NOT NULL,   -- stored with password_hash(), never plain text
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Used by: index.html (contact form) -> contact_form.php
CREATE TABLE IF NOT EXISTS contact_messages (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(255) NOT NULL,
    email         VARCHAR(255) NOT NULL,
    mobile_number VARCHAR(15)  NOT NULL,
    message       TEXT NOT NULL,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
