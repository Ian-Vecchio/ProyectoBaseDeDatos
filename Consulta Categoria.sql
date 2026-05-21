select 
    p.nombre,
    p.precio,
    c.nombre as categoria
from productos p
inner join categorias c
    on p.id_categoria = c.id_categoria
where c.nombre = '';
