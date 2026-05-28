-- Consulta Precio de Mayor a Menor
create view precio_mayormenor as
select 
    pub.id_publicacion, 
    pub.nombre_producto as producto, 
    pub.precio, 
    pub.stock, 
    u.nombre_usuario as vendedor
from publicacion pub
join usuario u on pub.id_autor = u.id_usuario
order by pub.precio desc;