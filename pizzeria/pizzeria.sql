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
  ('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'David', 'El administrador del sitio.', 2),
  ('reg1', 'b37433910bcb25e4f6a875a54a0e6394', 'pedro@gmail.com', 'Pedro', 'Me gusta la pizza!', 1),
  ('reg2', 'c8a7c7c976ffbde6b49cc0c637798c33', 'juan@ono.es', 'Juan', 'No me importa la dieta', 1);

# Estructura de tabla para la tabla `Masas`

CREATE TABLE masas (
  id_masa     TINYINT       NOT NULL DEFAULT 1,
  descripcion VARCHAR(50),
  tamano      DECIMAL(3, 2) NOT NULL DEFAULT 1,
  precio      DECIMAL(4, 2),
  imagen      VARCHAR(255)  NOT NULL,
  PRIMARY KEY (id_masa)
)
  ENGINE = innodb;


INSERT INTO masas VALUES (1, 'Masa fina', 0.75, 11.50, 'masa_fina.jpg');
INSERT INTO masas VALUES (2, 'Masa gruesa', 0.5, 8.90, 'masa_gruesa.jpg');
INSERT INTO masas VALUES (3, 'Masa rellena de queso', 1, 13.95, 'masa_queso.jpg');

# Estructura de tabla para la tabla `Ingredientes`

CREATE TABLE ingredientes (
  nombreIng   VARCHAR(20)  NOT NULL,
  descripcion VARCHAR(50)  NOT NULL DEFAULT '',
  imagen      VARCHAR(255) NOT NULL,
  PRIMARY KEY (nombreIng)
)
  ENGINE = innodb;


INSERT INTO ingredientes VALUES ('Tomate', 'Tomate natural', 'tomate.jpg');
INSERT INTO ingredientes VALUES ('Bacon', 'Frito', 'bacon.jpg');
INSERT INTO ingredientes VALUES ('Extra de mozarella', 'Doble de queso', 'mozarella.jpg');
INSERT INTO ingredientes VALUES ('Atún', 'En aceite de oliva virgen extra', 'atun.jpg');
INSERT INTO ingredientes VALUES ('Piña', 'De bote barato', 'piña.jpg');
INSERT INTO ingredientes VALUES ('Jamón', 'York', 'jamon.jpg');
INSERT INTO ingredientes VALUES ('Jamón Serrano', 'De cerdo ibérico', 'serrano.jpg');
INSERT INTO ingredientes VALUES ('Aceitunas', 'Negras', 'aceitunas.jpg');
INSERT INTO ingredientes VALUES ('Pimiento', 'Rojo', 'pimiento.jpg');
INSERT INTO ingredientes VALUES ('Cebolla', 'Ecológica', 'cebolla.jpg');

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


INSERT INTO pedidos VALUES (100, 'reg1', 1, 3, 'Bacon,Tomate,Extra de mozarella', 2, '22/01/2016 a las 14:17:30', 0);
INSERT INTO pedidos VALUES (101, 'reg2', 2, 3, 'Pimiento,Cebolla,Atún', 2, '23/01/2016 a las 14:19:22', 0);
INSERT INTO pedidos VALUES (102, 'reg1', 3, 2, 'Bacon,Cebolla', 1, '24/01/2011 a las 21:11:10', 0);
INSERT INTO pedidos VALUES (103, 'reg2', 1, 4, 'Bacon,Tomate,Extra de mozarella,Pimiento', 1, '25/01/2016 a las 13:57:09', 0);