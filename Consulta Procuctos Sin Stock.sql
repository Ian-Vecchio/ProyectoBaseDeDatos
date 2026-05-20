-- consulta ver productos sin stock 
create view productos_sin_stock as
select pub.id_publicacion, p.nombre as producto, p.precio, u.nombre_usuario as vendedor
from publicaciones pub
join productos p on pub.id_producto = p.id_producto
join usuarios u on pub.id_usuario = u.id_usuario
where pub.stock = 0;
