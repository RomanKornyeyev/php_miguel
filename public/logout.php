<?php

  // Iniciar la sesión
  require_once("../src/init.php");

  // Destruir todas las variables de sesión
  session_unset();

  // Destruir la sesión
  session_destroy();

  //Destruimos las cookies (necesario para el recuerdame)
  if(isset($_COOKIE["recuerdame"])){
    DWESBaseDatos::borrarToken($db, $_COOKIE["recuerdame"]);
    setcookie("recuerdame", null, time()-1);
  }

  // Redirigir al usuario a la página de inicio de sesión o inicio
  header("Location: index.php");
  exit;
?>