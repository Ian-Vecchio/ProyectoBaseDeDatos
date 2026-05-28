-- Consulta Ver Carrito
create view ver_carrito as
select 
    c.id_carrito, 
    u.nombre_usuario as comprador, 
    pub.nombre_producto as producto, 
    c.cantidad, 
    pub.precio as precio_unitario, 
    (c.cantidad * pub.precio) as total_producto
from carrito c
join usuario u on c.id_usuario = u.id_usuario
join publicacion pub on c.id_publicacion = pub.id_publicacion;