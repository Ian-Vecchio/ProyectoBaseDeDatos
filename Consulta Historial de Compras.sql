-- Consulta Historial de Compras
create view historial_compras as
select 
    c.id_compra, 
    c.fecha as fecha_compra, 
    u.nombre_usuario as comprador, 
    p.nombre_producto as producto, 
    c.cantidad, 
    c.monto_total as total_pagado
from compra c
join usuario u on c.id_comprador = u.id_usuario
join publicacion p on c.id_publicacion = p.id_publicacion;