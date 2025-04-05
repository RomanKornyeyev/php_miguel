CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  email VARCHAR(200) NOT NULL UNIQUE,
  passwd VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tokens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  token VARCHAR(255) NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  expires_at TIMESTAMP NOT NULL DEFAULT (CURRENT_TIMESTAMP + INTERVAL 7 DAY),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

INSERT INTO usuarios (nombre, email, passwd) 
VALUES 
('Miguel López', 'miguel.lopez@example.com', '$2y$12$3KOQP9Znx8uieqPtUZ8JXeRAsPCTUlGb7ytugDDmvjsdPcWhqMp8S'),
('Ana García', 'ana.garcia@example.com', '$2y$12$3KOQP9Znx8uieqPtUZ8JXeRAsPCTUlGb7ytugDDmvjsdPcWhqMp8S'),
('Carlos Pérez', 'carlos.perez@example.com', '$2y$12$3KOQP9Znx8uieqPtUZ8JXeRAsPCTUlGb7ytugDDmvjsdPcWhqMp8S'),
('Lucía Fernández', 'lucia.fernandez@example.com', '$2y$12$3KOQP9Znx8uieqPtUZ8JXeRAsPCTUlGb7ytugDDmvjsdPcWhqMp8S');