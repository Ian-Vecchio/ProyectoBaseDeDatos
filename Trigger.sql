DELIMITER $$

CREATE TRIGGER registrar_compra_y_registrar_Stock
BEFORE INSERT ON compra
FOR EACH ROW
BEGIN
    DECLARE stock_actual INT;
  
    SELECT stock INTO stock_actual
    FROM publicacion
    WHERE id_publicacion = NEW.id_publicacion;
  
    IF stock_actual IS NULL OR stock_actual < NEW.cantidad THEN
        -- Usamos MESSAGE_TEXT con doble 'S'
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Operacion cancelada: El producto no cuenta con el stock necesario para su adquisicion';
  
    ELSE

        UPDATE publicacion
        SET stock = stock - NEW.cantidad
        WHERE id_publicacion = NEW.id_publicacion;
  
    END IF; 

END$$ 

DELIMITER ;
