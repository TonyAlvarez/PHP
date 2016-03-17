DROP DATABASE pizzeria;

CREATE DATABASE IF NOT EXISTS pizzeria;

USE pizzeria;

# Estructura de tabla para la tabla `Clientes`

CREATE TABLE IF NOT EXISTS usuario
(
  login    VARCHAR(16)  NOT NULL,
  password VARCHAR(128) NOT NULL,
  email    VARCHAR(20)  NOT NULL,
  nombre   VARCHAR(16)  NOT NULL,
  firma    TEXT         NOT NULL,
  avatar   VARCHAR(255) NOT NULL DEFAULT 'avatar_defecto.jpg',
  tipo     INT(11)      NOT NULL DEFAULT 1,
  PRIMARY KEY (login)
)
  ENGINE = InnoDB;

INSERT INTO usuario (login, password, email, nombre, firma, tipo) VALUES
  ('admin', '$2y$09$PVDZeEGxsHLstVX4TGmbFezct1cIKZhiwE.jPlx5yGGpCVhfHhwYS', 'admin@pizza.com', 'Admin', 'Soy el amo.',
   2),
  ('reg1', 'b37433910bcb25e4f6a875a54a0e6394', 'pedro@gmail.com', 'Pedro', 'Me gusta la pizza!', 1),
  ('reg2', 'c8a7c7c976ffbde6b49cc0c637798c33', 'juan@ono.es', 'Juan', 'No me importa la dieta', 1);

# Estructura de tabla para la tabla `Masas`

CREATE TABLE masas (
  id_masa     TINYINT       NOT NULL    AUTO_INCREMENT,
  nombre      VARCHAR(50),
  descripcion VARCHAR(150),
  tamano      DECIMAL(3, 2) NOT NULL    DEFAULT 1,
  precio      DECIMAL(4, 2),
  imagen      VARCHAR(255)  NOT NULL,
  stock       INT           NOT NULL    DEFAULT 1,
  PRIMARY KEY (id_masa)
)
  ENGINE = innodb;

INSERT INTO masas (nombre, descripcion, tamano, precio, imagen)
VALUES ('Masa fina', 'Masa ultrafina para que disfrutes más del contenido', 0.75, 11.50, 'masa_fina.png');
INSERT INTO masas (nombre, descripcion, tamano, precio, imagen)
VALUES ('Masa gruesa', 'La masa de toda la vida', 0.5, 8.90, 'masa_gruesa.png');
INSERT INTO masas (nombre, descripcion, tamano, precio, imagen) VALUES
  ('Masa rellena de queso', 'Para los más exquisitos. ¡Ya nunca te dejarás los bordes!', 1, 13.95, 'masa_queso.png');

# Estructura de tabla para la tabla `Ingredientes`

CREATE TABLE pizzas (
  id_pizza     TINYINT      NOT NULL    AUTO_INCREMENT,
  nombrePizza  VARCHAR(20)  NOT NULL,
  descripcion  VARCHAR(50)  NOT NULL    DEFAULT '',
  ingredientes VARCHAR(100),
  imagen       VARCHAR(255) NOT NULL,
  stock        INT          NOT NULL    DEFAULT 1,
  PRIMARY KEY (id_pizza)
)
  ENGINE = innodb;

INSERT INTO pizzas (nombrePizza, descripcion, ingredientes, imagen)
VALUES ('Margarita', 'Para personas simples, masa y mucho queso', '3', 'margarita.png');
INSERT INTO pizzas (nombrePizza, descripcion, ingredientes, imagen)
VALUES ('Barbacoa', 'Un toque picante, con bacon, cebolla y maiz', '2,12,13', 'barbacoa.png');
INSERT INTO pizzas (nombrePizza, descripcion, ingredientes, imagen)
VALUES ('Campina', 'Para gente de campo, con pimiento verde, champiñones, tomate y aceitunas negras',
        '1,11,8,9', 'campina.png');
INSERT INTO pizzas (nombrePizza, descripcion, ingredientes, imagen)
VALUES ('Carbonara', 'Muy jugosa', '2,12,13', 'barbacoa.png');
INSERT INTO pizzas (nombrePizza, descripcion, ingredientes, imagen)
VALUES ('Hawaiana', 'Directa del trópico', '5,6', 'hawaiana.png');
INSERT INTO pizzas (nombrePizza, descripcion, ingredientes, imagen)
VALUES ('Pata negra', 'Para ibéricos', '1,7,9', 'pata_negra.png');
INSERT INTO pizzas (nombrePizza, descripcion, ingredientes, imagen)
VALUES ('Pollo', 'Con champiñones, maiz y  carne de pollo de corral', '8,13,14', 'pollo_champi.png');

# Estructura de tabla para la tabla `Ingredientes`

CREATE TABLE ingredientes (
  id_ingrediente TINYINT      NOT NULL    AUTO_INCREMENT,
  nombreIng      VARCHAR(20)  NOT NULL,
  descripcion    VARCHAR(50)  NOT NULL    DEFAULT '',
  imagen         VARCHAR(255) NOT NULL,
  stock          INT          NOT NULL    DEFAULT 1,
  PRIMARY KEY (id_ingrediente)
)
  ENGINE = innodb;

INSERT INTO ingredientes (nombreIng, descripcion, imagen) VALUES ('Tomate', 'Tomate natural', 'tomate.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen) VALUES ('Bacon', 'Frito', 'bacon.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen)
VALUES ('Extra de mozarella', 'Doble de queso', 'mozzarella.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen)
VALUES ('Atún', 'En aceite de oliva virgen extra', 'atun.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen) VALUES ('Piña', 'De bote barato', 'pina.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen) VALUES ('Jamón', 'York', 'jamon.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen) VALUES ('Jamón Serrano', 'De cerdo ibérico', 'serrano.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen)
VALUES ('Campiñones', 'Como los de Super Mario', 'champinon.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen) VALUES ('Aceitunas', 'Negras', 'aceitunas.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen) VALUES ('Pimiento', 'Rojo', 'pimiento.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen)
VALUES ('Pimiento Verde', 'Como el rojo, pero verde', 'pimiento_verde.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen) VALUES ('Cebolla', 'Ecológica', 'cebolla.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen) VALUES ('Maiz', 'Dulce', 'maiz.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen) VALUES ('Pollo', 'De campo', 'pollo.png');
INSERT INTO ingredientes (nombreIng, descripcion, imagen)
VALUES ('Anchoas', 'Sacadas del mar una a una', 'anchoas.png');

# Estructura de tabla para la tabla `Pedidos`

CREATE TABLE pedidos (
  id_Pedido    INT(4)      NOT NULL AUTO_INCREMENT,
  login        VARCHAR(16) NOT NULL,
  id_Masa      TINYINT     NOT NULL DEFAULT 1,
  numIng       TINYINT     NOT NULL DEFAULT 4,
  ingredientes VARCHAR(100),
  unidades     TINYINT     NOT NULL DEFAULT 1,
  fechayhora   VARCHAR(30) NOT NULL,
  servido      TINYINT     NOT NULL DEFAULT 0,
  PRIMARY KEY (id_pedido),
  FOREIGN KEY (login) REFERENCES usuario (login)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (id_Masa) REFERENCES masas (id_Masa)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = innodb
  COMMENT = 'Tabla de pedidos'
  AUTO_INCREMENT = 100;

INSERT INTO pedidos (login, id_Masa, numIng, ingredientes, unidades, fechayhora)
VALUES ('reg1', 1, 3, '1,4,7', 2, '22/01/2016 a las 14:17:30');
INSERT INTO pedidos (login, id_Masa, numIng, ingredientes, unidades, fechayhora)
VALUES ('reg2', 2, 3, '2,3,4,10', 2, '23/01/2016 a las 14:19:22');
INSERT INTO pedidos (login, id_Masa, numIng, ingredientes, unidades, fechayhora)
VALUES ('reg1', 3, 2, '1', 1, '24/01/2011 a las 21:11:10');
INSERT INTO pedidos (login, id_Masa, numIng, ingredientes, unidades, fechayhora)
VALUES ('reg2', 1, 4, '5,8', 1, '25/01/2016 a las 13:57:09');