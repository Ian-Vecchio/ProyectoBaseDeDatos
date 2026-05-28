-- Procedure Crear Producto
delimiter //

create procedure crear_publicacion (
    in p_id_publicacion int,
    in p_id_autor int,
    in p_nombre_producto varchar(100),
    in p_descripcion text,
    in p_imagen varchar(255),
    in p_precio decimal(10,2),
    in p_stock int,
    in p_estado varchar(50),
    in p_id_producto int
)
begin
    insert into publicacion (
        id_publicacion, id_autor, nombre_producto, descripcion, imagen, precio, stock, estado, id_producto
    )
    values (
        p_id_publicacion, p_id_autor, p_nombre_producto, p_descripcion, p_imagen, p_precio, p_stock, p_estado, p_id_producto
    );
end //
delimiter ;