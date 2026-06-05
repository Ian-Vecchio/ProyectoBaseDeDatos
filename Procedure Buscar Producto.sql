-- Procecdure Buscar Producto
DELIMITER //
create procedure buscar_productos(IN texto_busqueda varchar(50))
begin
    select * from publicacion 
    where Nombre_Producto like CONCAT('%', texto_busqueda, '%');
end //

DELIMITER ;
