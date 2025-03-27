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


  // Si puedes dividir el numero entre otro numero que sea menor al que te han dado y que te de 1 no es primo
  if(isset($_POST["numero"]))
  {
    //Inicializamos una variable que va a determinar si es primo o no primo
    $esPrimo = true;
    $numero = $_POST["numero"];

    //Vamos a reccorer desde el cero hasta el numero proporcionado para saber si alguno de esos numeros es divisible entre el numero proporcionado (en ese caso es primo)
    for ($i=2; $i < $numero; $i++) {
      if ($numero % $i == 0){
        $esPrimo = false;
      }
    }

    //Si el numero es primo
    if($esPrimo){
      $mensaje = "El número $numero es primo";
      $alertType = "success";
    }else{
      $mensaje = "El número $numero no es primo";
      $alertType = "danger";
    }
  }

  

?>

  <h1 class="text-center">ADINA EL NÚMERO JEJE</h1>

  <?php if (isset($mensaje)) { ?>
    <div class="alert alert-<?php echo $alertType?> text-center" style="max-width: 400px; margin: 25px auto;">
      <?= $mensaje ?>
    </div>
  <?php } ?>

  <form action="" method="post" class="form shadow-sm rounded p-5" style="max-width: 400px; margin: 0 auto;">
    <div class="mb-3">
      <label for="numero" class="form-label">Introduce el número</label>
      <input type="number" class="form-control" id="numero" name="numero" placeholder="1-100" value="<?=$numero?>" required min="1" max="100">
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Comprobar</button>
  </form>


<?php

  // ********* FIN BUFFER + LLAMADA AL TEMPLATE **********
  $content = ob_get_contents();
  ob_end_clean();
  require("template.php");

?>