<?php


  // ********* INFO PARA EL TEMPLATE **********
  $tituloHead = "Número Par o Impar ";
  $content;

  // ********* COMIENZO BUFFER **********
  ob_start();

  // Conservamos el valor del número introducido por el usuario
  if(isset($_POST["submit"])) {
    // numero
    if(isset($_POST["numero"])){
      $numero = htmlspecialchars($_POST["numero"]);
    }
  }

  // Comprobamos si se ha enviado el formulario
  if (isset($_POST['numero'])) {
    $numero = $_POST['numero'];
    $alertType = "primary";
    if ($numero % 2 == 0) {
      $mensaje = "El número es par";
    } else  {
      $alertType = "success";
      $mensaje = "El número es impar";
    }
  }

  

?>

  <h1 class="text-center">NÚMERO PAR / IMPAR</h1>

  <?php if (isset($mensaje)) { ?>
    <div class="alert alert-<?php echo $alertType?> text-center" style="max-width: 400px; margin: 25px auto;">
      <?= $mensaje ?>
    </div>
  <?php } ?>

  <form action="" method="post" class="form shadow-sm rounded p-5" style="max-width: 400px; margin: 0 auto;">
    <div class="mb-3">
      <label for="numero" class="form-label">Introduce el número</label>
      <input type="number" class="form-control" id="numero" name="numero" placeholder="1-100" value="<?=$numero?>" required>
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Comprobar</button>
  </form>


<?php

  // ********* FIN BUFFER + LLAMADA AL TEMPLATE **********
  $content = ob_get_contents();
  ob_end_clean();
  require("template.php");

?>