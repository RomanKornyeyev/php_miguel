<?php

  //si el usuario NO tiene la sesión iniciada
  if (!isset($_SESSION['id'])) {

    //comprobamos si el user tiene la cookie de recuerdame
    if(isset($_COOKIE['recuerdame'])){

      //si la tiene, cogemos el valor y comprobamos a ver si coincide con alguno de la base de datos
      $tkn = $_COOKIE['recuerdame'];
      $consulta = DWESBaseDatos::obtenTokenPorValor($db, $tkn);

      //si el token es válido y no está expirado
      if ($consulta != "" && $consulta['expires_at'] > date('Y-m-d H:i:s')) {
          
        //buscamos el user
        $consulta = DWESBaseDatos::obtenUsuarioPorToken($db, $tkn);

        //si la consulta devuelve un user, es que la cookie es buena, y hacemos $_SESSION de nombre
        if ($consulta != ""){

          // iniciamos la sesión
          $_SESSION['id'] = $consulta['id'];
          $_SESSION['nombre'] = $consulta['nombre'];
          $_SESSION['email'] = $consulta['email'];

          //alargamos la vida del token (7 días)
          DWESBaseDatos::alargarToken($db, $tkn);
        }
      }
    }
  }

?>