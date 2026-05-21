-- procedure agregar producto
 delimiter //
create procedure crear_producto (
in p_id_publicacion int ,
in p_id_producto int,
in p_id_usuario int,
in p_stock int
)
begin
insert into publicacion (
id_publicacion, id_producto, id_usuario, fecha, stock
)
values(
p_id_publicacion, p_id_producto, p_id_usuario, current_date(), p_stock
);

end//
delimiter ;