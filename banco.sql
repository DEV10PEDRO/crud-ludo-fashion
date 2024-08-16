CREATE DATABASE ludo_db;
USE ludo_db;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(30) NOT NULL
);


INSERT INTO usuario (nome, email, senha, telefone) VALUES 
("carlos", "carlos_silva@gmail.com", "102331", "98988237490"),
("ana", "ana_souza@gmail.com", "123456", "21998765432");

