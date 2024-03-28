<?php
// -> Importamos el main.php donde tenemos nuestros metodos que se repiten una y otra vez
require_once "./main.php";

// Almacenando datos del formulario, pero antes los pasamos por el metodo limpiarCadena
$nombre = limpiarCadena($_POST["usuario_nombre"]);
$apellido = limpiarCadena($_POST["usuario_apellido"]);
$usuario = limpiarCadena($_POST["usuario_usuario"]);
$email = limpiarCadena($_POST["usuario_email"]);
$clave_1 = limpiarCadena($_POST["usuario_clave_1"]);
$clave_2 = limpiarCadena($_POST["usuario_clave_2"]);

// Validando los campos obligatorios
if ($nombre == "" || $apellido == "" || $usuario == "" || $clave_1 == "" || $clave_2 == "") {
    echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              No has llenado todos los campos que son obligatorios
          </div>
          ';
    exit();
}
