-- consulta precio de mayor a menor
create view precio_mayormenor as
select p.id_producto, p.nombre as producto, p.precio, pub.stock, u.nombre_usuario as vendedor
from publicaciones pub
join productos p on pub.id_producto = p.id_producto
join usuarios u on pub.id_usuario = u.id_usuario
order by p.precio desc;