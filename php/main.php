<?php
// * Conexion con la BD
// Es mas recomendable usar PDO que mysqli, ya que PDO es una extension mas generica para otras base de datos, en cambio mysqli solo es específicamente para mysql, ademas que PDO es mas segura y facil de mantener ya que proporciona una interfaz orientada a objetos

// -> Definimos el metodo para realizar una conexion a la BD
function conexion()
{ // funcion para realizar la conexion con la BD
   $pdo = new PDO("mysql:host=localhost;dbname=sistema_inventario", "root", ""); // 1Parametro: tipo de bd: servidor; bdNombre, usuario, password del usuario
   return $pdo;
}

// Insercion en la tabla categorias
//$pdo->query("INSERT INTO categoria(categoriaNombre, categoriaUbicacion) VALUES('Prueba', 'Texto Ubicacion')");// usamos el metodo query del objeto PDO

// * Metodo para validar los datos de entrada del login
function verificarDatos($filtro, $cadena)
{
   if (preg_match("/^" . $filtro . "$/", $cadena)) { // metodo para comparar una cadena con una expresion regular
      return false; // ponemos false cuando la cadena coincida con el filtro
   } else {
      return true; // ponemos true cuando la cadena no coincida devolviendo el error del filtro
   }
}
// Ejemplo de uso del metodo de validacion de datos
   /*$nombre = "Carlos";
   if(verificarDatos("[a-zA-Z]{6,10}", $nombre)){ // recibe la expresion regular y la cadena
      echo "Los datos no coinciden";
   }*/

// * Metodo para evitar Inyecciones SQL
function limpiarCadena($cadena)
{
   $cadena = trim($cadena); // trim elimina el espacio en blanco del inicio y el final de la cadena
   $cadena = stripslashes($cadena); // stripslashes quita las barras de un string con comillas escapadas
   $cadena = str_ireplace("<script>", "", $cadena); // ? str_ireplace reemplaza un string por otro siendo insensible a mayusculas o minisculas, aqui evitamos que se injecte codigo javascript
   $cadena = str_ireplace("</script>", "", $cadena); // aqui lo cerramos la etiqueta javascript
   // Y asi continuamos con mas validaciones
   $cadena = str_ireplace("<script src", "", $cadena);
   $cadena = str_ireplace("<script type=", "", $cadena);
   $cadena = str_ireplace("SELECT * FROM", "", $cadena);
   $cadena = str_ireplace("DELETE FROM", "", $cadena);
   $cadena = str_ireplace("INSERT INTO", "", $cadena);
   $cadena = str_ireplace("DROP TABLE", "", $cadena);
   $cadena = str_ireplace("DROP DATABASE", "", $cadena);
   $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
   $cadena = str_ireplace("SHOW TABLES;", "", $cadena);
   $cadena = str_ireplace("SHOW DATABASES;", "", $cadena);
   $cadena = str_ireplace("<?php", "", $cadena);
   $cadena = str_ireplace("?>", "", $cadena);
   $cadena = str_ireplace("--", "", $cadena);
   $cadena = str_ireplace("^", "", $cadena);
   $cadena = str_ireplace("<", "", $cadena);
   $cadena = str_ireplace("[", "", $cadena);
   $cadena = str_ireplace("]", "", $cadena);
   $cadena = str_ireplace("==", "", $cadena);
   $cadena = str_ireplace(";", "", $cadena);
   $cadena = str_ireplace("::", "", $cadena);
   $cadena = trim($cadena);
   $cadena = stripslashes($cadena);
   return $cadena;
}
// Ejemplo de intento de ataque con un script
/*$texto = "<script>ATAQUE GG   </script>"; // Solo muestra ATAQUE GG por que no esta permitido los scripts
   echo limpiarCadena($texto);*/

// * Metodo para renombrar imagenes
function renombrarFotos($nombre)
{
   $nombre = str_ireplace(" ", "_", $nombre);
   $nombre = str_ireplace("/", "_", $nombre);
   $nombre = str_ireplace("#", "_", $nombre);
   $nombre = str_ireplace("-", "_", $nombre);
   $nombre = str_ireplace("$", "_", $nombre);
   $nombre = str_ireplace(".", "_", $nombre);
   $nombre = str_ireplace(",", "_", $nombre);
   $nombre = $nombre . "_" . rand(0, 100); // rand nos da un numero aleatorio entre un rango definido que generara un numero en caso de que se suban archivos con nombre repetidos
   return $nombre;
}
// Ejemplo de renombramiento a una imagen
/*$foto = "Nintendo 64/70"; // reemplazara todos los caracteres establecidos por una barra baja
   echo renombrarFotos($foto);*/

// * Metodo para generar un paginador de tablas
function paginadorTablas($pagina, $totalPaginas, $url, $botones)
{
   $tabla = '<nav class="pagination is-centered is-rounded " role="navigation" aria-label="pagination">';
   // -> Controlar la primera pagina
   if ($pagina <= 1) {
      $tabla .= '
         <a class="pagination-previous is-disabled" disabled>Anterior</a>
         <ul class="pagination-list">
         ';
   } else {
      $tabla .= '
         <a class="pagination-previous" href="' . $url . ($pagina - 1) . '">Siguiente</a>
         <ul class="pagination-list">
            <li><a class="pagination-link" href="' . $url . '1">1</a></li>
            <li><span class="pagination-ellipsis">&hellip;</span></li>
         ';
   }

   // -> Controlar las paginas intermedias
   $ci = 0;
   for($i = $pagina; $i <= $totalPaginas; $i++){
      if($ci >= $botones){
         break;
      }
      if($pagina == $i){
         $tabla.='<li><a class="pagination-link is-current" href="'.$url.$i.'">'.$i.'</a></li>';
         $i.'</a></li>';
      }else{
         $tabla.='<li><a class="pagination-link" href="'.$url.$i.'">'.$i.'</a></li>';
         $i.'</a></li>';
      }
      $ci++;
   }

   // -> Controlar la ultima pagina
   if ($pagina == $totalPaginas) {
      $tabla .= '
            </ul>
            <a class="pagination-next is-disabled" disabled>Siguiente</a>
         ';
   } else {
      $tabla .= '
            <li><span class="pagination-ellipsis">&hellip;</span></li>
            <li><a class="pagination-link" href="'.$url.$totalPaginas.'">'.$totalPaginas.'</a></li>
            </ul>
            <a class="pagination-next" href="' . $url . ($pagina + 1) . '">Siguiente</a>
         ';
   }
   $tabla .= '</nav>';
   return $tabla;
}
