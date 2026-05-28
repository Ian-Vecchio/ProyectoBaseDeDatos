drop database if exists pipilibres;
create database pipilibres;
use pipilibres;

-- tabla de roles
create table roles (
    id_rol int primary key,
    nombre_rol varchar(50)
);

-- tabla de categorias
create table categorias (
    id_categoria int primary key,
    nombre_categoria varchar(100)
);

-- tabla de usuarios
create table usuario (
    id_usuario int primary key,
    nombre_usuario varchar(50),
    nombre varchar(100),
    apellido varchar(100),
    dni varchar(20),
    correo_electronico varchar(100),
    contraseña varchar(255),
    saldo decimal(10, 2) default 0.00,
    id_rol int,
    foreign key (id_rol) references roles(id_rol)
);

-- tabla de direcciones
create table direccion (
    id_direccion int primary key,
    id_usuario int,
    calle varchar(100),
    altura int,
    codigo_postal varchar(20),
    foreign key (id_usuario) references usuario(id_usuario)
);

-- tabla de ingresos de dinero
create table ingresos (
    id_ingresado int primary key,
    metodo_de_pago varchar(50),
    saldo_ingresado decimal(10, 2),
    fecha datetime,
    id_usuario int,
    foreign key (id_usuario) references usuario(id_usuario)
);

-- tabla de productos
create table productos (
    id_producto int primary key,
    id_categoria int,
    foreign key (id_categoria) references categorias(id_categoria)
);

-- tabla de publicaciones
create table publicacion (
    id_publicacion int primary key,
    id_autor int,
    nombre_producto varchar(100),
    descripcion text,
    imagen varchar(255),
    precio decimal(10, 2),
    stock int,
    estado varchar(50),
    id_producto int,
    foreign key (id_autor) references usuario(id_usuario),
    foreign key (id_producto) references productos(id_producto)
);

-- tabla de historial de precios
create table historial_precio (
    id_historial int primary key auto_increment,
    id_producto int,
    precio_antiguo decimal(10, 2),
    fecha datetime,
    foreign key (id_producto) references productos(id_producto)
);

-- tabla de valoraciones de productos
create table valoraciones (
    id_valoracion int primary key,
    id_publicacion int,
    titulo_valorcion varchar(100),
    comentario text,
    imagen varchar(255),
    fecha date,
    foreign key (id_publicacion) references publicacion(id_publicacion)
);

-- tabla de carrito
create table carrito (
    id_carrito int primary key auto_increment,
    id_publicacion int,
    id_dueño_carrito int,
    cantidad int,
    foreign key (id_publicacion) references publicacion(id_publicacion),
    foreign key (id_dueño_carrito) references usuario(id_usuario)
);

-- tabla de compra
create table compra (
    id_compra int primary key auto_increment,
    id_comprador int,
    id_publicacion int,
    cantidad int,
    monto_total decimal(10, 2),
    fecha datetime,
    foreign key (id_comprador) references usuario(id_usuario),
    foreign key (id_publicacion) references publicacion(id_publicacion)
);

-- tabla de envios
create table envio (
    id_envio int primary key auto_increment,
    id_compra int,
    fecha_envio datetime,
    fecha_llegada datetime,
    id_direccion int,
    foreign key (id_compra) references compra(id_compra),
    foreign key (id_direccion) references direccion(id_direccion)
);
