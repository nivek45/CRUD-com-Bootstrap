USE wda_crud;
-- cria a tabela do projeto
CREATE TABLE cars (
  id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  modelo varchar(50) NOT NULL,
  marca varchar(30) NOT NULL,
  ano int NOT NULL,
  foto varchar(250) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL
);

-- insere dados na tabela
 
INSERT INTO cars (modelo, marca, ano, foto, created, modified)
VALUES 
('California', 'Ferrari', 2012, 'ferrari.jpeg', NOW(), NOW());
