<nav class="navbar" role="navigation" aria-label="main navigation">
   <div class="navbar-brand">
      <a class="navbar-item" href="index.php?vista=home">
         <img src="./img/logoDafrancode.jpg">
      </a>

      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
         <span aria-hidden="true"></span>
         <span aria-hidden="true"></span>
         <span aria-hidden="true"></span>
      </a>
   </div>

   <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
         <!-- <a class="navbar-item">
            Home
         </a>

         <a class="navbar-item">
            Documentation
         </a> -->

         <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">Usuarios</a>
            <div class="navbar-dropdown">
               <a class="navbar-item" href="index.php?vista=user_new">Nuevo</a>
               <a class="navbar-item" href="index.php?vista=user_list">Lista</a>
               <a class="navbar-item" href="index.php?vista=user_search">Buscar</a>
            </div>
         </div>
         <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">Categorias</a>
            <div class="navbar-dropdown">
               <a class="navbar-item">Nueva</a>
               <a class="navbar-item">Lista</a>
               <a class="navbar-item">Buscar</a>
            </div>
         </div>
         <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">Productos</a>
            <div class="navbar-dropdown">
               <a class="navbar-item">Nuevo</a>
               <a class="navbar-item">Lista</a>
               <a class="navbar-item">Por categorias</a>
               <a class="navbar-item">Buscar</a>
            </div>
         </div>
      </div>

      <div class="navbar-end">
         <div class="navbar-item">
            <div class="buttons">
               <a class="button is-primary is-rounded"><strong>Mi cuenta</strong></a>
               <a class="button is-light is-rounded">Cerrar Sesión</a>
            </div>
         </div>
      </div>
   </div>

</nav>