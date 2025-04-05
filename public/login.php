<?php

/*********** INIT (DB Y DEMÁS) ***********/
require_once("../src/init.php");

// si el form se ha enviado
if (isset($_POST["submit"])) {
    // Validar correo
    if (isset($_POST['email']) && $_POST['email'] != "" && $_POST['email'] != null) {
        $datos['email'] = clean_input($_POST['email']);
    } else {
        $errores['email'] = "<span class='text-danger'>*Introduce un correo válido (ej: ejemplo@dominio.com)</span>";
    }

    // Validar password
    if (!empty($_POST['password']) && strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 16) {
        $datos['password'] = clean_input($_POST['password']);
        echo strlen($_POST['password']);
    } else {
        $errores['password'] = "<span class='text-danger'>*La password no puede estar vacía, y tiene que ser entre 6 y 16 digitos</span>";
    }

    //si NO hay errores, hace algo
    if (count($errores) == 0) {

        //buscamos si el user existe
        $consulta = DWESBaseDatos::obtenUsuarioPorMail($db, $datos['email']);

        //si el user existe (si la consulta no está vacía)
        if($consulta != ""){

            // comparamos la contraseña en texto plano que nos llega del form, con la contra hash que tenemos en la BD
            if(password_verify($datos['password'], $consulta["passwd"])){

                // iniciar sesión
                $_SESSION['id'] = $consulta['id'];
                $_SESSION['nombre'] = $consulta['nombre'];
                $_SESSION['email'] = $consulta['email'];

                // recuerdame
                if (isset($_POST['recuerdame']) && $_POST['recuerdame'] == "on") {
                    //generamos token
                    $token = bin2hex(openssl_random_pseudo_bytes(DWESBaseDatos::LONG_TOKEN)); //64 bytes = 128 caracteres hexadecimales

                    //insertamos token en BD
                    DWESBaseDatos::insertarToken($db, $_SESSION['id'], $token);

                    //creamos la cookie
                    setcookie(
                        "recuerdame",
                        $token,
                        [
                            "expires" => time() + 7 * 24 * 60 * 60,
                            /*"secure" => true,*/
                            "httponly" => true
                        ]
                    );
                }
                
                // redirect
                header("Location: ./index.php");
                exit;
            }
        }
    }
}

// ********* INFO PARA EL TEMPLATE **********
$tituloHead = "Login de usuario";
$content;

// ********* COMIENZO BUFFER **********
ob_start();

?>

<h1 class="text-center">Login</h1>

<form action="" method="post" class="form shadow-sm rounded p-5" style="max-width: 400px; margin: 0 auto;">
    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@dominio.com" value=<?php if (isset($datos['email'])) echo $datos['email']; ?>>
        <?php if (isset($errores['email'])) echo $errores['email']; ?>
    </div>

    <!-- Contraseña -->
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="********">
        <?php if (isset($errores['password'])) echo $errores['password']; ?>
    </div>

    <!-- Recuerdame -->
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="recuerdame" name="recuerdame">
        <label class="form-check-label" for="recuerdame">Recuérdame</label>
    </div>

    <button class="btn btn-primary" type="submit" name="submit">Login</button>
</form>

<?php

// ********* FIN BUFFER + LLAMADA AL TEMPLATE **********
$content = ob_get_contents();
ob_end_clean();
require("template.php");

?>