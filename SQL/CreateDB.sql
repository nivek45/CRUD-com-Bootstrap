-- cria o banco de dados
CREATE DATABASE wda_crud;
-- seleciona o banco de dados
USE wda_crud;
-- cria a tabela do projeto
CREATE TABLE customers (
  id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  cpf_cnpj varchar(14) NOT NULL,
  birthdate datetime NOT NULL,
  address varchar(255) NOT NULL,
  hood varchar(100) NOT NULL,
  zip_code varchar(8) NOT NULL,
  city varchar(100) NOT NULL,
  state varchar(2) NOT NULL,
  phone varchar(11) NOT NULL,
  mobile varchar(11) NOT NULL,
  ie varchar(15) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL
);
-- insere dados na tabela
 
INSERT INTO customers (name,  cpf_cnpj, birthdate, address,
  hood, zip_code, city, state, phone, mobile, ie, created,
  modified) 
  VALUES
  ('Fulano de Tal', '123.456.789-00', '1989-01-01', 'Rua da Web, 123', 
'Internet', '12345678', 'Sorocaba', 'SP', '15 34118899', '15934118899', '1234566464', 
'2024-08-09', '2024-08-09'),
('Ciclano de Tal', '123.456.788-00', '1989-01-01', 'Rua da Web, 124', 
'Internet', '12345678', 'Sorocaba', 'SP', '15 34118800', '15934118800', '1234566400', 
'2024-08-09', '2024-08-09');