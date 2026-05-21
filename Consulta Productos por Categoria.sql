select 
    c.nombre as categoria,
    count(p.id_producto) as cantidad_productos
from categorias c
inner join productos p
    on c.id_categoria = p.id_categoria
group by c.nombre;