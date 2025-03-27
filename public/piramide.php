<?php

  function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  //datos y errores para el form
  $datos = [];
  $errores = [];

  // si el form se ha enviado
  if (isset($_POST["submit"])) {
    //comprobación de numero
    

    //si NO hay errores, hace algo
    if (count($errores) == 0) {
      //hace algo 
    }
  }


  // ********* INFO PARA EL TEMPLATE **********
  $tituloHead = "Número Aleatorio - Adivina el número";
  $content;

  // ********* COMIENZO BUFFER **********
  ob_start();

?>

  <h1 class="text-center">ADINA EL NÚMERO JEJE</h1>

  <form action="" method="post" class="form shadow-sm rounded p-5" style="max-width: 400px; margin: 0 auto;">
    <!-- numero -->
    
    
    <button class="btn btn-primary" type="submit" name="submit">Generar</button>
  </form>

<?php

  // ********* FIN BUFFER + LLAMADA AL TEMPLATE **********
  $content = ob_get_contents();
  ob_end_clean();
  require("template.php");

?>