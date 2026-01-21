CREATE DATABASE IF NOT EXISTS realmadrid CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE realmadrid;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro DATE NOT NULL,
    es_socio TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS delanteros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    edad INT NOT NULL,
    sueldo DECIMAL(10,2) NOT NULL,
    goles INT NOT NULL DEFAULT 0
);

INSERT INTO delanteros (nombre, edad, sueldo, goles) VALUES
('Karim Benzema', 35, 500000.00, 25),
('Vinicius Jr', 23, 300000.00, 18),
('Joselu', 33, 150000.00, 10);
