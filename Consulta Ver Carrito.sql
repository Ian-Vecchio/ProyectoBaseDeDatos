-- consulta ver carrito
create view ver_carrito as
select dc.id_carrito, u.nombre_usuario as comprador, p.nombre as producto, dc.cantidad, dc.precio as precio_unitario, (dc.cantidad * dc.precio) as total_producto
from detalle_carro dc
join carritos c on dc.id_carrito = c.id_carrito
join usuarios u on c.id_comprador = u.id_usuario
join publicaciones pub on dc.id_publicacion = pub.id_publicacion
join productos p on pub.id_producto = p.id_producto;