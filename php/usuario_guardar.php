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

// -> Verificando integridad de los datos
$regexEspeciales = "^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,40}$";
$regexAlfanumericos = "[a-zA-Z0-9]{4,20}";
$regexPasswords = "[a-zA-Z0-9$@#.\-]{7,100}";

if (verificarDatos($regexEspeciales, $nombre)) {
    echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              El <b>Nombre</b> no coincide con el formato solicitado...
          </div>
          ';
    exit();
}
if (verificarDatos($regexEspeciales, $apellido)) {
    echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              El <b>Apellido</b> no coincide con el formato solicitado...
          </div>
          ';
    exit();
}
if (verificarDatos($regexEspeciales, $usuario)) {
    echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              El <b>Nombre de Usuario</b> no coincide con el formato solicitado...
          </div>
          ';
    exit();
}
if (verificarDatos($regexPasswords, $clave_1) || verificarDatos($regexPasswords, $clave_2)) {
    echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              El <b>La contraseña</b> no coincide con el formato solicitado...
          </div>
          ';
    exit();
}

// -> Verificando los datos del campo usuario
if ($usuario != "") {
    $check_usuario = conexion();
    $check_usuario = $check_usuario->query("SELECT usuarioLogin from usuario where usuarioLogin = '$usuario'");
    if ($check_usuario->rowCount() > 0) { // rowCount() obtiene el numero de filas afectadas por una sentencia SQL 
        echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              El <b>Nombre de Usuario</b> que proporcionaste ya se encuentra registrado, por favor eliga otro
          </div>
          ';
        exit();
    }
    // ! Cerramos la conexion con la BD
    $check_usuario = null;
}

// -> Verificando los datos del campo password
if($clave_1 != $clave_2){
    echo '
    <div class="notification is-danger is-light">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        Las <b>contraseñas</b> que proporcionaste no coinciden
    </div>
    ';
  exit();
}else{
    // Encriptacion de las contraseñas
    $clave = password_hash($clave_1, PASSWORD_BCRYPT, ["cost" => 10]); // el tercer parametro de cost, un valor mas alto de "cost" significa que el proceso de hashing sera mas lento pero producira un hash mas seguro

}

// -> Verificando los datos del campo email
if ($email != "") {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validamos con el metodo filter_var para emails
        $check_email = conexion();
        $check_email = $check_email->query("SELECT usuarioEmail from usuario where usuarioEmail = '$email'");
        if ($check_email->rowCount() > 0) { // rowCount() obtiene el numero de filas afectadas por una sentencia SQL 
            echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              El <b>Correo</b> que proporcionaste ya se encuentra registrado, por favor eliga otro
          </div>
          ';
            exit();
        }
        // ! Cerramos la conexion con la BD
        $check_email = null;
    } else {
        echo '
          <div class="notification is-danger is-light">
              <strong>¡Ocurrio un erro inesperado!</strong><br>
              El <b>Correo</b> que proporcionaste no coincide con el formato solicitado...
          </div>
          ';
        exit();
    }
}

// -> INSERTANDO DATOS DEL USUARIO
// Forma no tan segura de insercion de datos
/*$guardar_usuario = conexion();
$guardar_usuario = $guardar_usuario->query("INSERT INTO usuario (usuarioNombre, usuarioApellido, usuarioLogin, usuarioPassword, usuarioEmail) values('$nombre', '$apellido', '$usuario', '$clave', '$email')");*/

// ! query() ejecuta consultas de una forma no tan segura, en cambio prepare() no evita injecciones SQL
// Forma mucha mas segura
$guardar_usuario = conexion();
// Preparamos la consulta
$guardar_usuario = $guardar_usuario->prepare("INSERT INTO usuario (usuarioNombre, usuarioApellido, usuarioLogin, usuarioPassword, usuarioEmail) values(:nombre, :apellido, :usuario, :clave, :email)"); // ? Colocamos como marcador ":"

// Referenciamos los marcadores
$marcadores=[
    ":nombre" => $nombre,
    ":apellido" => $apellido,
    ":usuario" => $usuario,
    ":clave" => $clave,
    ":email" => $email,
];
$guardar_usuario->execute($marcadores);

// Validamos que en caso de que se registre con normalidad o no el usuario
if($guardar_usuario -> rowCount() == 1){
    echo '
    <div class="notification is-info is-light">
        <strong>¡Usuario registrado con éxito!</strong>
    </div>
    ';
}else{
    echo '
    <div class="notification is-danger is-light">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        No se pudo registrar el Usuario, por favor intente nuevamente
    </div>
    ';
}
// ! Cerramos la conexion con la BD
$guardar_usuario = null;
