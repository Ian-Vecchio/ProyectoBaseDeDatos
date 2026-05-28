-- Procedure Agregar Direccion
delimiter //
create procedure p_agregar_direccion(
    in p_id_usuario int,
    in p_calle varchar(100),
    in p_altura int,
    in p_codigo_postal varchar(20)
)
begin
        insert into direccion (id_usuario, calle, altura, codigo_postal)
        values (p_id_usuario, p_calle, p_altura, p_codigo_postal);
        
end //
delimiter ;