<?php
// -> Cerramos la sesion que creamos en el sistema al logearnos
session_destroy();

// -> Realizamos la redireccion al login
      // ? headers_sent() comprueba si se han enviado encabezados HTTP al navegador o no
      if(headers_sent()){ // comprobamos si hemos llevado encabezados
         echo "<script> window.location.href = 'index.php?vista=login'; </script>"; // redireccionamos con javascript
      }else{
         header("Location: index.php?vista=login"); // redireccionamos al archivo principal
      }