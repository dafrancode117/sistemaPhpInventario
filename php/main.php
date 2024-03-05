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

   // VERIFICAR DATOS
   function verificarDatos($filtro, $cadena){
      if(preg_match("/^".$filtro."$/", $cadena)){ // metodo para comparar una cadena con una expresion regular
         return false; // ponemos false cuando la cadena coincida con el filtro
      }else{
         return true; // ponemos true cuando la cadena no coincida devolviendo el error del filtro
      }
   }
   $nombre = "Carlos";
   
   // Ejemplo de uso del metodo de verificacion de datos
   /*if(verificarDatos("[a-zA-Z]{6,10}", $nombre)){ // recibe la expresion regular y la cadena
      echo "Los datos no coinciden";
   }*/

   // EVITAR INJECCIONES SQL
   function limpiarCadena($cadena){
      $cadena = trim($cadena); // trim elimina el espacio en blanco del inicio y el final de la cadena
      $cadena = stripslashes($cadena); // stripslashes quita las barras de un string con comillas escapadas
      $cadena = str_ireplace("<script>", "",$cadena); // vuelve  la cadena insensible a cadenas mayusculas o minusculas, aqui evitamos que se injecte codigo javascript
      $cadena = str_ireplace("</script>", "",$cadena); // aqui lo cerramos la etiqueta javascript
      // Y asi continuamos con mas validaciones
      $cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;
   }
   // Ejemplo de intento de ataque con un script
   /*$texto = "<script>ATAQUE GG   </script>"; // Solo muestra ATAQUE GG por que no esta permitido los scripts
   echo limpiarCadena($texto);*/

   // RENOMBRAR FOTOS
   function renombrarFotos($nombre){
		$nombre=str_ireplace(" ", "_", $nombre);
		$nombre=str_ireplace("/", "_", $nombre);
		$nombre=str_ireplace("#", "_", $nombre);
		$nombre=str_ireplace("-", "_", $nombre);
		$nombre=str_ireplace("$", "_", $nombre);
		$nombre=str_ireplace(".", "_", $nombre);
		$nombre=str_ireplace(",", "_", $nombre);
		$nombre=$nombre."_".rand(0,100); // rand nos da un numero aleatorio entre un rango definido que generara un numero en caso de que se suban archivos con nombre repetidos
		return $nombre;
	}
   /*$foto = "Nintendo 64/70"; // reemplazara todos los caracteres establecidos por una barra baja
   echo renombrarFotos($foto);*/

   // GENERAR PAGINADOR DE TABLAS
   
?>