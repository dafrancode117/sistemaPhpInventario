<!-- //* Vista de la pagina del Login *//  -->

<body class="body_login">
   <div class="containerLog">
         <span style="--clr:#ADFCF9;"></span>
         <span style="--clr:#89A894;"></span>
         <span style="--clr:#4B644A;"></span>

         <div  class="form-contenedor">
            <form action="" method="POST" autocomplete="off">

               <h2 class="title-form-contenedor">Iniciar Sesión</h2>
               <div class="input-container">
                  <input type="text" placeholder="Usuario" name="loginUsuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
               </div>
               <div class="input-container">
                  <input type="password" placeholder="Contraseña" name="loginClave" pattern="[a-zA-Z0-9$@#.\-]{7,100}" maxlength="100" required>
               </div>
               <div class="input-container">
                  <input type="submit" value="Iniciar Sesión">
               </div>

               <?php
               // * Codigo que nos permite identificar si hemos enviado el formulario
               if (isset($_POST['loginUsuario']) && isset($_POST['loginClave'])) {
                  require_once "./php/main.php";
                  require_once "./php/iniciarSesion.php";
               }
               ?>
            </form>
         </div>
   </div>

</body>