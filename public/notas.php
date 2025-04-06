<?php

/*********** INIT (DB Y DEMÁS) ***********/
require_once("../src/init.php");

// area privada, solo para usuarios logueados
if (!isset($_SESSION['id'])) {
  header("Location: index.php");
  exit;
}

// sacamos las notas del usuario
$notas = DWESBaseDatos::obtenNotasPorIdUsuario($db, $_SESSION['id']);

// ********* INFO PARA EL TEMPLATE **********
$tituloHead = "Mis notas";
$content;

// ********* COMIENZO BUFFER **********
ob_start();

?>

<h1 class="text-center mb-5">Mis notas</h1>

<div>
  <?php if (isset($_GET['mensaje']) && isset($_GET['status'])) { ?>
    <div class="alert alert-<?=htmlspecialchars($_GET['status'])?> text-center" style="max-width: 400px; margin: 25px auto;">
      <?=htmlspecialchars($_GET['mensaje'])?>
    </div>
  <?php }?>
</div>

<div class="row">

  <?php foreach ($notas as $value) { ?>
    <div class="col-sm-12 mb-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?=$value['titulo']?></h5>
          <p class="text-muted mb-1"><?=date("H:i, d/m/Y", strtotime($value['created_at']))?></p>
          <p class="card-text"><?=$value['contenido']?></p>
          
          <a href="./editarNota.php?id_nota=<?=$value['id']?>" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i> Modificar nota</a>
          <!-- las acciones destructivas se hacen por POST -->
          <form action="./borrarNota.php" method="post" class="d-inline-block form-borrar-nota">
            <input type="hidden" name="id_nota" value="<?=$value['id']?>">
            <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i> Borrar nota</button>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if (count($notas) == 0) { ?>
    <div class="col-sm-12 mb-3">
      <div class="alert alert-info text-center" style="max-width: 400px; margin: 25px auto;">
        No tienes notas creadas
      </div>
    </div>
  <?php } ?>

  <div class="col-sm-12">
    <div class="w-100 d-flex justify-content-center align-items-center p-4">
      <div>
        <a href="./editarNota.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Añadir una nota</a>
      </div>
    </div>
  </div>
</div>

<?php

// ********* FIN BUFFER + LLAMADA AL TEMPLATE **********
$content = ob_get_contents();
ob_end_clean();
require("template.php");

?>