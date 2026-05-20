drop database if exists PipiLibres;
create database PipiLibres;
use Pipilibres;

-- tabla de categorías
create table categorias (
    id_categoria int primary key,
    nombre varchar(100)
);

-- tabla de usuarios
create table usuarios (
    id_usuario int primary key,
    nombre_usuario varchar(50),
    password varchar(255),
    nombre varchar(100),
    apellido varchar(100),
    dni varchar(20)
);

-- tabla de roles
create table roles (
    id_rol int primary key,
    nombre varchar(50),
    id_usuario int,
    foreign key (id_usuario) references usuarios(id_usuario)
);

-- tabla de productos
create table productos (
    id_producto int primary key,
    nombre varchar(100),
    precio decimal(10, 2),
    descripcion text,
    id_categoria int,
    foreign key (id_categoria) references categorias(id_categoria)
);

-- tabla de publicaciones
create table publicaciones (
    id_publicacion int primary key,
    id_producto int,
    id_usuario int,
    fecha date,
    stock int,
    foreign key (id_producto) references productos(id_producto),
    foreign key (id_usuario) references usuarios(id_usuario)
);

-- tabla de carritos
create table carritos (
    id_carrito int primary key,
    id_comprador int,
    fecha date,
    foreign key (id_comprador) references usuarios(id_usuario)
);

-- tabla detalle_carro
create table detalle_carro (
    id_detalle int primary key,
    id_carrito int,
    id_publicacion int,
    cantidad int,
    precio decimal(10, 2),
    foreign key (id_carrito) references carritos(id_carrito),
    foreign key (id_publicacion) references publicaciones(id_publicacion)
);

-- tabla de compras
create table compras (
    id_compra int primary key,
    id_detalle int,
    foreign key (id_detalle) references detalle_carro(id_detalle)
);

-- tabla de transacciones
create table transacciones (
    id_transaccion int primary key,
    id_compra int,
    monto decimal(10, 2),
    metodo_pago varchar(50), -- ej: 'tarjeta', 'saldo_cuenta', 'transferencia'
    estado varchar(20),      -- ej: 'aprobada', 'rechazada', 'pendiente'
    fecha_transaccion datetime,
    foreign key (id_compra) references compras(id_compra)
);
