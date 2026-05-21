CREATE PROCEDURE agregar_publicacion(
  IN id_publicacion_a_borrar INT
  )
  BEGIN
   DELETE FROM publicacion
   WHERE id_publicacion = id_publicacion_a_borrar;
  end $$
  
Delimiter $$
