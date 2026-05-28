-- Consulta Ver Productos Sin Stock
create view productos_sin_stock as
select 
    pub.id_publicacion, 
    pub.nombre_producto as producto, 
    pub.precio, 
    u.nombre_usuario as vendedor
from publicacion pub
join usuario u on pub.id_autor = u.id_usuario
where pub.stock = 0;