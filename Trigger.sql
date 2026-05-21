delimiter $$
create trigger registrar_compra_y_registrar_stock
before INSERT ON compra
for each row
BEGIN
declare  STOCK_ANUAL int;
Select Stock into stock_actual
from Publicacion
where id_Publicacion = new.id_publicacion;

if stock_actual is Null Or stock_actual <= 0 THEN
Signal sqlstate '45000'
SET MESSAGE_TEXT = 'Operacion Cancelada: el producto no tiene stock (Es igual a 0)';
ELSE
     UPDATE publicacion
	 Set stock = stock - 1
     Where id_publicacion = NEW.id_Publicacion;
END IF;

END$$

DELIMITER  ;
