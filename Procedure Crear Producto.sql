-- procedure crear producto
 delimiter //
create procedure crear_producto (
in p_id_producto int,
in p_nombre varchar(100),
in p_precio decimal(10,2),
in p_descripcion text,
in p_categoria int
)
begin
insert into productos (
id_producto, nombre, precio, descripcion, categoria
)
values(
p_id_producto, p_nombre, p_precio, p_descripcion, p_categoria
);

end//
delimiter ;
