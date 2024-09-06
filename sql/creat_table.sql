CREATE DATABASE pesquisa_db;

USE pesquisa_db;

CREATE TABLE respostas_pesquisa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    avaliacao_servico INT NOT NULL,
    atendimento VARCHAR(255) NOT NULL,
    comentarios_adicionais TEXT,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- CREATE TABLE usuarios (
--     id INT AUTO_INCREMENT PRIMARY KEY,          
--     username VARCHAR(50) NOT NULL UNIQUE,       
--     password VARCHAR(255) NOT NULL,            
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- ALTER TABLE pesquisa_db.usuarios
-- ADD COLUMN role ENUM('master', 'admin') NOT NULL DEFAULT 'admin';

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('master', 'admin') NOT NULL DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);