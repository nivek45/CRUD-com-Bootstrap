USE wda_crud;

CREATE TABLE usuarios(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    nome varchar(50) not null,
    user varchar(50) not null,
    password varchar(100) not null,
    foto varchar(250),
    created datetime NOT NULL,
    modified datetime NOT NULL
);

INSERT INTO `usuarios`(`nome`, `user`, `password`, `foto`, `created`, `modified`) 
VALUES
('admin','admin','$2a$06$Cf1f11ePArKlBJomM0F6a.Pox/QC3GLABmR7AxqNPx53fILjUMxai', 'admin.jpg', '2024-11-17 16:09:53', '2024-11-17 16:09:53' ), 
('banana','banana','$2a$06$Cf1f11ePArKlBJomM0F6a.dbSaPhv/Gs8bPTVTLj19dTXmefHDEQO', 'Banana_pratapng-328x328.png', '2024-11-17 16:09:53', '2024-11-17 16:09:53' ),
('jorge','jorge','$2a$06$Cf1f11ePArKlBJomM0F6a.ScEGP4R7lSCuP4mgQzKN7PLEdOXfLDC', '', '2024-11-17 16:09:53', '2024-11-17 16:09:53');
