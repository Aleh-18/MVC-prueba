CREATE TABLE hobbies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hobby VARCHAR(100) NOT NULL UNIQUE
);

INSERT INTO hobbies (hobby) VALUES
('videojuegos'),
('cine'),
('musica'),
('dibujar');

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contrasenia VARCHAR(100) NOT NULL
);


CREATE TABLE usuario_hobbies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    hobby_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (hobby_id) REFERENCES hobbies(id)
);

INSERT INTO usuarios (usuario, correo, contrasenia) VALUES
('Ale', 'ale@gmail.com', '1234'),
('Juan', 'juan@gmail.com', 'abcd'),
('Maria', 'maria@gmail.com', 'pass'),
('Pedro', 'pedro@gmail.com', 'qwerty');


INSERT INTO usuario_hobbies (usuario_id, hobby_id) VALUES
(1, 1),  -- videojuegos
(1, 2),  -- cine
(1, 3),  -- musica
(1, 4);  -- dibujar



