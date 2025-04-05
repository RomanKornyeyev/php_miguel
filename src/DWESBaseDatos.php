<?php

/*
Clase para facilitar las conexiones y consultas a bases de datos
*/


class DWESBaseDatos {

  private $conexion = null;
  private $sentencia = null;
  private $executed = false;
  
  const LONG_TOKEN = 64;
  const ADMIN = "admin";
  const USUARIO = "usuario";
  const VERIFICADO_SI = "si";
  const VERIFICADO_NO = "no";
  const PENDIENTE = "pendiente";
  const ACEPTADA = "aceptada";

  const REGISTROS_POR_PAGINA = 20;
  const MAX_BUDDIES_FEED = 3;
  const MAX_PAG_PAGINADOR = 3;

  const RUTA_DOMINIO_BASE = "www.seriesbuddies.es";

  /*
    Patrón Singletone para poder usar la clase en proyectos más grandes
  */

  private static $instanciaUnica = null;

  private function __construct() { } // Solo se puede crear desde el método obtenerInstancia

  public static function obtenerInstancia() {
    if (self::$instanciaUnica == null)
    {
      self::$instanciaUnica = new DWESBaseDatos();
    }

    return self::$instanciaUnica;
  }

  function inicializa(
    $basedatos,         // Nombre debe ser especificado O el archivo si es SQLite
    $usuario  = 'mi_usuario', // Ignorado si es SQLite
    $pass     = 'mi_pass', // Ignorado si es SQLite
    $motor    = 'mysql',
    $serverIp = 'localhost',
    $charset  = 'utf8mb4',
    $options  = null
  ) {
    if($motor != "sqlite") {
      $cadenaConexion = "$motor:host=$serverIp;dbname=$basedatos;charset=$charset";
    } else {
      $cadenaConexion = "$motor:$basedatos";
    }

    if($options == null){
      $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // La preparación de las consultas no es simulada
                                                // más lento pero más seguro
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Cuando se produce un error
                                                                // salta una excepción
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Cuando traemos datos lo hacemos como array asociativo
      ];
    }

    try {
      if($motor != "sqlite") {
        $this->conexion = new PDO($cadenaConexion, $usuario, $pass, $options);
      } else {
        $this->conexion = new PDO($cadenaConexion, null, null, $options);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      exit('No ha sido posible la conexión');
    }
  }

  /*
    Permite ejecutar una consulta preparada con parámetros posicionales.
      Parámetros
        1º SQL
        2º ... parámetros o array con parámetros
  */
  function ejecuta(string $sql, ...$parametros) {
    $this->sentencia = $this->conexion->prepare($sql);

    if($parametros == null){
      $this->executed = $this->sentencia->execute();
      return;
    }

    if($parametros != null && is_array($parametros[0])) {
      $parametros = $parametros[0]; // Si nos pasan un array lo usamos como parámetro
    }

    $this->executed = $this->sentencia->execute($parametros);
  }

  function obtenDatos(){
    return $this->sentencia->fetchAll();
  }

  function obtenElDato(){
    return $this->sentencia->fetch();
  }

  function getLastId(){
    return $this->conexion->lastInsertId();
  }

  function getExecuted(){
    return $this->executed;
  }

  function __destruct(){
    $this->conexion = null;
  }

  // ***************** QUERYS *****************
  
  // ====== SELECTS ======
  // Obtiene todos los usuarios
  public static function obtenUsuarios ($db) {
    $db->ejecuta("SELECT * FROM usuarios");
    return $db->obtenDatos();
  }

  // login usuario
  public static function obtenUsuarioPorMail ($db, $email) {
    $db->ejecuta("SELECT * FROM usuarios WHERE email=?;", $email);
    return $db->obtenElDato(); // nos devuelve un solo registro
  }

  // Seleccionar token por valor
  public static function obtenTokenPorValor($db, $token) {
    $db->ejecuta("SELECT * FROM tokens WHERE token=?;", $token);
    return $db->obtenElDato();
  }

  // buscar usuario asociado a token
  public static function obtenUsuarioPorToken($db, $token) {
    $db->ejecuta("SELECT u.* FROM usuarios u INNER JOIN tokens t ON u.id = t.usuario_id WHERE t.token = ?;", $token);
    return $db->obtenElDato();
  }

  // alargar token 7 días
  public static function alargarToken($db, $token) {
    $db->ejecuta("UPDATE tokens SET expires_at=(NOW() + INTERVAL 7 DAY) WHERE token=?;", $token);
    return $db->getExecuted();
  }





  // ====== INSERTS ======
  // Registro de un usuario
  public static function insertarUsuario($db, $nombre, $email, $passwd) : bool
  {
    $db->ejecuta(
      "INSERT INTO usuarios (nombre, email, passwd) VALUES (?,?,?);",
      $nombre, $email, $passwd
    );

    if ($db->getExecuted()) {
      return true;
    }else{
      return false;
    }
  }

  // Insertar token
  public static function insertarToken($db, $usuario_id, $token) : bool
  {
    $db->ejecuta(
      "INSERT INTO tokens (usuario_id, token) VALUES (?, ?);",
      $usuario_id, $token
    );
    if ($db->getExecuted()) {
      return true;
    }else{
      return false;
    }
  }







  // ====== DELETES ======
  // Borrar token
  public static function borrarToken($db, $token) : bool
  {
    $db->ejecuta(
      "DELETE FROM tokens WHERE token=?;",
      $token
    );
    if ($db->getExecuted()) {
      return true;
    }else{
      return false;
    }
  }
}

?>