<?php
   require_once "./main.php";

   // Almacenando datos
   $nombre = limpiarCadena($_POST["usuario_nombre"]);
   $apellido = limpiarCadena($_POST["usuario_apellido"]);
   $usuario = limpiarCadena($_POST["usuario_usuario"]);
   $email = limpiarCadena($_POST["usuario_email"]);
   $clave_1 = limpiarCadena($_POST["usuario_clave_1"]);
   $clave_2 = limpiarCadena($_POST["usuario_clave_2"]);
   
   // Verificando campos obligatorios
   if($nombre=="" || $apellido=="" || $usuario=="" || $clave_1=="" || $clave_2=="") {
      echo'
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              No has llenado todos los campos que son obligatorios
          </div>
          ';
      exit();
  }
   ?>