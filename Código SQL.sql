drop database if exists pipilibres;
create database pipilibres;
use pipilibres;

-- tabla usuario
create table usuario (
    id_usuario int auto_increment primary key,
    nombre_usuario varchar(50) unique,
    nombre varchar(50),
    apellido varchar(50),
    compras int,
    ventas int,
    dni varchar(20)
);

-- tabla categorias
create table categorias (
    id_categoria int auto_increment primary key,
    nombre varchar(50)
);

-- tabla productos
create table productos (
    id_producto int auto_increment primary key,
    nombre varchar(100),
    precio decimal(10,2),
    stock int,
    id_vendedor int,
    id_categoria int,
    foreign key (id_vendedor) references usuario(id_usuario),
    foreign key (id_categoria) references categorias(id_categoria)
);

-- tabla compra
create table compra (
    id_compra int auto_increment primary key,
    id_comprador int,
    total decimal(10,2),
    foreign key (id_comprador) references usuario(id_usuario)
);

-- tabla detallecompra
create table detallecompra (
    id_detalle_compra int auto_increment primary key,
    id_compra int,
    id_producto int,
    cantidad int,
    precio_unitario decimal(10,2),
    foreign key (id_compra) references compra(id_compra),
    foreign key (id_producto) references productos(id_producto)
);

-- tabla carrito
create table carrito (
    id_carrito int auto_increment primary key,
    fecha date,
    id_comprador int,
    total decimal(10,2),
    foreign key (id_comprador) references usuario(id_usuario)
);