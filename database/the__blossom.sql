DROP DATABASE IF EXISTS the__blossom;
CREATE DATABASE IF NOT EXISTS the__blossom
CHARACTER SET = 'latin1'
COLLATE = 'latin1_spanish_ci';
USE the__blossom;

CREATE TABLE usuarios(
    id INT(255) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(255),
    correo VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(10) NOT NULL,
    rol VARCHAR(20),
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(correo)
)Engine = InnoDB;

CREATE TABLE categorias(
    id INT(255) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    CONSTRAINT pk_categorias PRIMARY KEY(id)
)Engine = InnoDB;

CREATE TABLE productos(
    id INT(255) AUTO_INCREMENT NOT NULL,
    categoria_id INT(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    stock INT(255) NOT NULL,
    talla VARCHAR(20) NOT NULL,
    descripcion TEXT,
    marca VARCHAR(100),
    precio FLOAT(100, 2) NOT NULL,
    oferta VARCHAR(2),
    fecha DATE NOT NULL,
    imagen VARCHAR(255),
    CONSTRAINT pk_productos PRIMARY KEY(id),
    CONSTRAINT fk_productos_categorias FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)Engine = InnoDB;
CREATE TABLE pagos(
    id INT(255) AUTO_INCREMENT NOT NULL, 
    id_transaccion VARCHAR(20) NOT NULL, 
    fecha DATETIME NOT NULL,
    status VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    id_cliente VARCHAR(255) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    CONSTRAINT pk_datapago PRIMARY KEY(id)
)Engine = InnoDB;
CREATE TABLE pedidos(
    id INT(255) AUTO_INCREMENT NOT NULL,
    usuario_id INT(255) NOT NULL,
    pago_id INT(255),
    municipio VARCHAR(100) NOT NULL,
    localidad VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    referencia TEXT,
    telefono VARCHAR(255) NOT NULL,
    coste FLOAT(200, 2) NOT NULL,
    estado VARCHAR(20) NOT NULL,
    fecha DATE,
    hora TIME,
    CONSTRAINT pk_pedidos PRIMARY KEY(id),
    CONSTRAINT pk_pedidos_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id),
    CONSTRAINT pk_pedidos_pago FOREIGN KEY(pago_id) REFERENCES pagos(id)
)Engine = InnoDB;

CREATE TABLE lineas_pedidos(
    id INT(255) AUTO_INCREMENT NOT NULL,
    pedido_id INT(255) NOT NULL,
    producto_id INT(255) NOT NULL,
    unidades INT(255) NOT NULL,
    CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_linea_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)Engine = InnoDB;
