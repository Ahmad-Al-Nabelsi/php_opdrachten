CREATE DATABASE login_system;
USE login_system;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Voer gebruikersgegevens in met wachtwoord codering
INSERT INTO users (username, password) VALUES
('user1', SHA1('pass1')),
('user2', SHA1('pass2')),
('user3', SHA1('pass3'));
