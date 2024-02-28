<?php
   // Conexion con una BD
   // Es mas recomendable usar PDO que mysqli, ya que PDO es una extension mas generica para otras base de datos, en cambio mysqli solo es específicamente para mysql, ademas que PDO es mas segura y facil de manter ya que proporciona una interfaz orientada a objetos

   // Definimos las variables que se va a usar:

   function conexion(){ // funcion para realizar la conexion con la BD
      $pdo = new PDO("mysql:host=localhost;dbname=inventario", "root", ""); // 1Parametro: tipo de bd: servidor; bdNombre, usuario, password del usuario
      return $pdo;
   }

   // Insercion en la tabla categorias
   //$pdo->query("INSERT INTO categoria(categoriaNombre, categoriaUbicacion) VALUES('Prueba', 'Texto Ubicacion')");// usamos el metodo query del objeto PDO

?>