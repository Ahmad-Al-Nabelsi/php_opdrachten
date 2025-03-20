CREATE DATABASE IF NOT EXISTS empl;
USE empl;

CREATE TABLE IF NOT EXISTS user_empl (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Voornaam VARCHAR(50) NOT NULL,
    Achternaam VARCHAR(50) NOT NULL,
    Woonplaats VARCHAR(100) NOT NULL,
    Geboortedatum DATE NOT NULL,
    Geslacht ENUM('manneljk', 'vrouwelijk', 'onbekend') NOT NULL
);