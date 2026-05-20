-- consulta historial de compras
create view historial_compras as
select com.id_compra, car.fecha as fecha_compra, u.nombre_usuario as comprador, p.nombre as producto, dc.cantidad, (dc.cantidad * dc.precio) as total_pagado
from compras com
join detalle_carro dc on com.id_detalle = dc.id_detalle
join carritos car on dc.id_carrito = car.id_carrito
join usuarios u on car.id_comprador = u.id_usuario
join publicaciones pub on dc.id_publicacion = pub.id_publicacion
join productos p on pub.id_producto = p.id_producto;
