<?php

/************************** CONEXIÓN A BD simple, no necesaria al usar la librería DWESBaseDatos ***********************/
// $host = 'localhost';       // o el host de tu servidor (por ejemplo: 127.0.0.1 o mysql)
// $db   = 'php_miguel';
// $user = 'root';
// $pass = 'root';

// $dsn = "mysql:host=$host;dbname=$db";

// $options = [
//   PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // lanza excepciones ante errores
//   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // devuelve resultados como arrays asociativos
//   PDO::ATTR_EMULATE_PREPARES   => false,                  // usa consultas preparadas nativas
// ];

// try {
//   $pdo = new PDO($dsn, $user, $pass, $options);
//   // echo "Conexión exitosa";
// } catch (PDOException $e) {
//   // Error al conectar
//   echo "Error de conexión: " . $e->getMessage();
// }




// CREDENCIALES
require_once("config.php");

// DB
require_once("DWESBaseDatos.php");

//instancia de acceso a BD
$db = DWESBaseDatos::obtenerInstancia();
$db->inicializa(
  $CONFIG['db_name'],
  $CONFIG['db_user'],
  $CONFIG['db_pass']
);

// FLASHES (avisos)
$FLASH_ERRORS = [];
$FLASH_SUCCESS = [];

// ERRORES Y DATOS FORM
$errores = [];
$datos = [];

// CLEAN INPUT FROM FORMS
function clean_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// sesión
session_start();

// recuerdame
require_once("recuerdame.php");