select 
    u.nombre_usuario,
    sum(dc.cantidad) as total_vendidos
from detalle_carro dc
inner join publicaciones pb
    on dc.id_publicacion = pb.id_publicacion
inner join usuarios u
    on pb.id_usuario = u.id_usuario
group by u.nombre_usuario
order by total_vendidos desc;