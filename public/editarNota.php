<?php

/*********** INIT (DB Y DEMÁS) ***********/
require_once("../src/init.php");

// area privada, solo para usuarios logueados
if (!isset($_SESSION['id'])) {
  header("Location: index.php");
  exit;
}

// editar / nueva nota. En base a si tiene GET de id_nota o no
$es_editar = false;
if (isset($_GET['id_nota'])) {
  $es_editar = true;
}

// obtenemos la info del form
if ($es_editar == true) {
  // extraer la data de la nota de la BD
  $nota = DWESBaseDatos::obtenNotaPorId($db, $_GET['id_nota']);
}

// si el form se ha enviado
if (isset($_POST["submit"])) {
  // Validar título
  if (isset($_POST['titulo']) && preg_match('/^[a-zA-Z0-9\s]{1,50}$/', $_POST['titulo'])) {
    $datos['titulo'] = clean_input($_POST['titulo']);
  } else {
    $errores['titulo'] = "<span class='text-danger'>*El título es obligatorio, tiene que ser letras y números longitud min 1, max 50</span>";
  }

  // Validar contenido
  if (isset($_POST['contenido']) && $_POST['contenido'] != "" && $_POST['contenido'] != null && strlen($_POST['contenido']) <= 500) {
    $datos['contenido'] = clean_input($_POST['contenido']);
  } else {
    $errores['contenido'] = "<span class='text-danger'>*El contenido es obligatorio y tiene que ser inferior a 500 caracteres</span>";
  }

  //si NO hay errores, hace algo
  if (count($errores) == 0) {

    // si es editar, actualizamos la nota
    if ($es_editar == true) {
      // comprobamos que es el usuario que ha creado la nota
      if ($nota['usuario_id'] != $_SESSION['id']) {
        header("Location: ./notas.php");
        exit;
      }

      DWESBaseDatos::actualizaNotaPorId($db, $_GET['id_nota'], $datos['titulo'], $datos['contenido']);
      header("Location: ./notas.php?mensaje=Nota actualizada correctamente&status=success");
      exit;
    }else{
      // si no es editar, insertamos la nota
      DWESBaseDatos::insertarNota($db, $_SESSION['id'], $datos['titulo'], $datos['contenido']);
      header("Location: ./notas.php?mensaje=Nota creada correctamente&status=success");
      exit;
    }
  }
}





// ********* INFO PARA EL TEMPLATE **********
if ($es_editar == true) {
  $tituloHead = "Editar notas";
}else{
  $tituloHead = "Añadir notas";
}

$content;

// ********* COMIENZO BUFFER **********
ob_start();

?>

<?php if ($es_editar == true) { ?>
  <h1 class="text-center mb-5">Editar nota</h1>
<?php }else{ ?>
  <h1 class="text-center mb-5">Añadir nota</h1>
<?php } ?>

<form action="" method="post" class="form shadow-sm rounded p-5" style="max-width: 600px; margin: 0 auto;">
  <div class="mb-3">
    <label for="titulo" class="form-label">Título</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título de la nota" value="<?php echo isset($_POST['titulo']) ? $_POST['titulo'] : ($es_editar == true ? $nota['titulo'] : ''); ?>">
    <?php if (isset($errores['titulo'])) echo $errores['titulo']; ?>
  </div>

  <div class="mb-3">
    <label for="contenido" class="form-label">Contenido</label>
    <textarea class="form-control" id="contenido" name="contenido" rows="5" placeholder="Contenido"><?php echo isset($_POST['contenido']) ? $_POST['contenido'] : ($es_editar == true ? $nota['contenido'] : ''); ?></textarea>
    <?php if (isset($errores['contenido'])) echo $errores['contenido']; ?>
  </div>

  <div class="text-center p-2">
    <button type="submit" class="btn btn-primary" id="submit" name="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
  </div>
</form>

<div class="text-center p-5">
  <a href="./notas.php" class="btn btn-outline-primary"><i class="fa-solid fa-arrow-left"></i> Volver a mis notas</a>
</div>


<?php

// ********* FIN BUFFER + LLAMADA AL TEMPLATE **********
$content = ob_get_contents();
ob_end_clean();
require("template.php");

?>