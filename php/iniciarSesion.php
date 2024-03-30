<?php
// * Archivo de Inicio de Sesion del sistema

// -> Almacenando datos del formulario, pero antes los pasamos por el metodo limpiarCadena
$usuario = limpiarCadena($_POST["loginUsuario"]);
$clave = limpiarCadena($_POST["loginClave"]);

// -> Validando los campos obligatorios
if ($usuario == "" || $clave == "") {
   echo '
         <div class="notification is-danger is-light">
             <strong>¡Ocurrio un error inesperado!</strong><br>
             No has llenado todos los campos que son obligatorios
         </div>
         ';
   exit();
}

// -> Verificando integridad de los datos
$regexEspeciales = "[a-zA-Z0-9]{4,20}";
$regexPasswords = "[a-zA-Z0-9$@#.\-]{7,100}";

if (verificarDatos($regexEspeciales, $usuario)) {
   echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              El <b>Nombre de Usuario</b> no coincide con el formato solicitado...
          </div>
          ';
   exit();
}
if (verificarDatos($regexPasswords, $clave)) {
   echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              El <b>La contraseña</b> no coincide con el formato solicitado...
          </div>
          ';
   exit();
}

// -> Realizamos una consulta a la bd para verificar el usuario ingresado
$check_usuario = conexion();
$check_usuario = $check_usuario->query("SELECT * FROM usuario WHERE usuarioLogin = '$usuario'");

if ($check_usuario->rowCount() == 1) {
   // ? fetch() nos permite recuperar filas de resultados de una consulta SQL
   $check_usuario = $check_usuario -> fetch();

   // ? password_verify() comprueba que un texto coincida con una clave hecha por un hash, devuelve un valor booleano
   if($check_usuario['usuarioLogin'] == $usuario && password_verify($clave, $check_usuario['usuarioPassword'])){
      // -> Incluimos las variables de sesion del sistema
      $_SESSION['id'] = $check_usuario['usuarioId'];
      $_SESSION['nombre'] = $check_usuario['usuarioNombre'];
      $_SESSION['apellido'] = $check_usuario['usuarioApellido'];
      $_SESSION['usuario'] = $check_usuario['usuarioLogin'];

      // -> Realizamos la redireccion al sistema
      // ? headers_sent() comprueba si se han enviado encabezados HTTP al navegador o no
      if(headers_sent()){ // comprobamos si hemos llevado encabezados
         echo "<script> window.location.href = 'index.php?vista=home'; </script>"; // redireccionamos con javascript
      }else{
         header("Location: index.php?vista=home"); // redireccionamos al archivo principal
      }
      
   }else{
      echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              El <b>Nombre de Usuario</b> o <b>Contraseña</b> que proporcionaste son incorrectos
          </div>
          ';
   }

} else {
   echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              El <b>Nombre de Usuario</b> o <b>Contraseña</b> que proporcionaste son incorrectos
          </div>
          ';
   // exit(); -> No es necesario el exit() ya que esta parte de codigo es la ultima del archivo
}
// ! Cerramos la conexion con la BD
$check_usuario = null;
