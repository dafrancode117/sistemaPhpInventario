<?php
// * ARCHIVO PRINCIPAL DEL SISTEMA
// -> Incluimos las variables de sesion
require_once "./inc/sessionStart.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
   <?php include_once "./inc/head.php" ?>
</head>

<body>
   <header>
      <?php
      // -> Condicional que verifica si la variable de tipo get viene definida o no
      if (!isset($_GET["vista"]) || $_GET["vista"] == "") { // isset es una funcion que verifica que una variable este definida y no sea null
         $_GET["vista"] = "login";
      }

      // -> Condicional que verifica que exista una vista que no sea la del "login" ni la de error "404" para acceder al sistema
      if (is_file("./views/" . $_GET["vista"] . ".php") && $_GET["vista"] != "login" && $_GET["vista"] != "404") { // is_file es un metodo que indica que el directorio es un directorio normal

         // ! -> Cierre de Sesion forzado para los usuarios que no ha iniciado sesion y quieren entrar al sistema modificando la URL
         // Usamos las veriables de sesion que se crean para validar
         if ((!isset($_SESSION['id']) || $_SESSION['id'] == "") || (!isset($_SESSION['usuario']) || $_SESSION['usuario'] == "")) {
            // -> Llamamos al archivo logout del sistema
            include './views/logout.php';
            exit(); // detenemos la ejecucion del programa
         }

         // Carga de las vistas del sistema
         include_once "./inc/navbar.php";
         include_once "./views/" . $_GET["vista"] . ".php";
         include_once "./inc/script.php";
      } else {

         // -> Condicional que verifica que la vista si es un 'login' o un 'error 404'
         if ($_GET["vista"] == "login") {
            include_once "./views/login.php";
         } else {
            include_once "./views/404.php";
         }
      }
      ?>
   </header>
</body>

</html>