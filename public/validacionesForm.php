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
  $formValido = false;

  // si el form se ha enviado
  if (isset($_POST["submit"])) {
    //comprobación del nombre
    if (isset($_POST['nombre']) && $_POST['nombre'] != "" && $_POST['nombre'] != null){
      $datos['nombre'] = clean_input($_POST['nombre']);
    }else{
      $errores['nombre'] = "<span class='text-danger'>*El campo nombre no puede estar vacío</span>";
    }

    //comprobación del ciudad
    if (isset($_POST['ciudad']) && $_POST['ciudad'] != "" && $_POST['ciudad'] != null){
      $datos['ciudad'] = clean_input($_POST['ciudad']);
    }else{
      $errores['ciudad'] = "<span class='text-danger'>*El campo ciudad no puede estar vacío</span>";
    }

    //comprobación de edad
    if (isset($_POST['edad']) && $_POST['edad'] != "" && $_POST['edad'] != null && $_POST['edad'] > 0 && $_POST['edad'] < 100){
      $datos['edad'] = clean_input($_POST['edad']);
    }else{
      $errores['edad'] = "<span class='text-danger'>*El campo edad no puede estar vacío y tiene que ser superior a 0 e inferior a 100</span>";
    }

    //si NO hay errores, hace algo
    if (count($errores) == 0) {
      //hace algo (CRUD BD)
      $formValido = true;
    }
  }


  // ********* INFO PARA EL TEMPLATE **********
  $tituloHead = "Número Aleatorio - Adivina el número";
  $content;

  // ********* COMIENZO BUFFER **********
  ob_start();

?>

  <h1 class="text-center">Validaciones form</h1>

  <?php if ($formValido) { ?>
    <div class="alert alert-success text-center" style="max-width: 400px; margin: 25px auto;">
      El formulario se ha validado correctamente
    </div>
  <?php } else if (isset($_POST['submit']) && !$formValido){ ?>
    <div class="alert alert-danger text-center" style="max-width: 400px; margin: 25px auto;">
      El formulario no es válido
    </div>
  <?php } ?>

  <form action="" method="post" class="form shadow-sm rounded p-5" style="max-width: 400px; margin: 0 auto;">
    <!-- Nombre -->
    <div class="mb-3">
      <label for="nombre" class="form-label">Introduce tu nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="ej: Miguel" value=<?php if (isset($datos['nombre'])) echo $datos['nombre']; ?>>
      <?php if (isset($errores['nombre'])) echo $errores['nombre']; ?>
    </div>

    <!-- Ciudad -->
    <div class="mb-3">
      <label for="ciudad" class="form-label">Introduce tu ciudad</label>
      <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ej: Madrid" value=<?php if (isset($datos['ciudad'])) echo $datos['ciudad']; ?>>
      <?php if (isset($errores['ciudad'])) echo $errores['ciudad']; ?>
    </div>

    <!-- Edad -->
    <div class="mb-3">
      <label for="edad" class="form-label">Introduce tu edad</label>
      <input type="number" class="form-control" id="edad" name="edad" placeholder="1-100" value=<?php if (isset($datos['edad'])) echo $datos['edad']; ?>>
      <?php if (isset($errores['edad'])) echo $errores['edad']; ?>
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Comprobar</button>
  </form>


<?php

  // ********* FIN BUFFER + LLAMADA AL TEMPLATE **********
  $content = ob_get_contents();
  ob_end_clean();
  require("template.php");

?>