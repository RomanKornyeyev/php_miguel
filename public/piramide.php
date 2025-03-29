<?php

function clean_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//datos y errores para el form
$datos = [];
$errores = [];
$formEsValido = false;

// si el form se ha enviado
if (isset($_POST["submit"])) {
  //comprobación de numero
  if ($_POST["numero"] != null && $_POST["numero"] <= 15 && $_POST["numero"] >= 1) {
    $datos["numero"] = clean_input($_POST["numero"]);
  } else {
    $errores["numero"] = "El campo numero no puede estar vacio y tiene que estar entre el 1 y el 15";
  }


  //si NO hay errores, hace algo
  if (count($errores) == 0) {
    //hace algo 
    $formEsValido = true;
    echo "El formulario ha sido validado completamente";
  } else {
    echo "El formulario no ha sido validado";
  }
}


// ********* INFO PARA EL TEMPLATE **********
$tituloHead = "Número Aleatorio - Adivina el número";
$content;

// ********* COMIENZO BUFFER **********
ob_start();

?>


<h1 class="text-center">PIRÁMIDE</h1>

<form action="" method="post" class="form shadow-sm rounded p-5" style="max-width: 400px; margin: 0 auto;">
  <!-- numero -->
  <div class="mb-3">
    <label for="numero" class="form-label">Introduce un numero</label>
    <input type="number" class="form-control" id="numero" name="numero" placeholder="1-15" value="<?php if (isset($datos['numero'])) echo $datos['numero'];?>">
    <?php
    if (isset($errores["numero"])) {
      echo "<span class='text-danger'>" . $errores["numero"] . "</span>";
    }
    ?>
  </div>
  <button class="btn btn-primary" type="submit" name="submit">Generar</button>
</form>

<div class="shadow-sm rounded p-5" style="max-width: 400px; margin: 0 auto;">
  <h2>Pirámide generada</h2>
  <div class="alert alert-success text-center" style="max-width: 400px; margin: 25px auto;">
  <?php 
  if ($formEsValido == true){
    for ($i=1; $i <= $datos["numero"]; $i++) { 
      for ($j=1; $j <= $i ; $j++) { 
        echo "*";
      }
      echo "<br>";
    }
  } 
  ?> 
  </div>
</div>

<?php

// ********* FIN BUFFER + LLAMADA AL TEMPLATE **********
$content = ob_get_contents();
ob_end_clean();
require("template.php");

?>