<?php
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
         // Condicional que verifica si la variable de tipo get viene definida o no
         
         if(!isset($_GET["vista"]) || $_GET["vista"] == ""){ // isset es una funcion que verifica que una variable este definida y no sea null
            $_GET["vista"] = "login";
         }
         if(is_file("./views/" . $_GET["vista"] . ".php") && $_GET["vista"] != "login" && $_GET["vista"] != "404"){ // is_file es un metodo que indica que el directorio es un directorio normal
            include_once "./inc/navbar.php";
            include_once "./views/" . $_GET["vista"] . ".php";
            include_once "./inc/script.php";
            
         } else{
            if($_GET["vista"] == "login"){
               include_once "./views/login.php";
            } else{
               include_once "./views/404.php";
            }
         }
      ?>
   </header>
</body>

</html>