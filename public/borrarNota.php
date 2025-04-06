<?php

/*********** INIT (DB Y DEMÁS) ***********/
require_once("../src/init.php");

// area privada, solo para usuarios logueados
if (!isset($_SESSION['id'])) {
  header("Location: index.php");
  exit;
}

// comprobamos que nos venga el id de nota
if (!isset($_POST['id_nota'])) {
  header("Location: ./notas.php?mensaje=Error al borrar la nota (sin id de nota)&status=danger");  
  exit;
}

// obtenemos la info de la nota
$nota = DWESBaseDatos::obtenNotaPorId($db, $_POST['id_nota']);

// comprobamos que es el usuario que ha creado la nota
if ($nota['usuario_id'] != $_SESSION['id']) {
  header("Location: ./notas.php?mensaje=Error al borrar la nota (no eres el autor)&status=danger");  
  exit;
}

// borramos la nota
DWESBaseDatos::borrarNotaPorId($db, htmlspecialchars($_POST['id_nota']));
header("Location: ./notas.php?mensaje=Nota borrada correctamente&status=success");
exit;


?>