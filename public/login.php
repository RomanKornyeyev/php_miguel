<?php

function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//datos y errores para el form
$errores = [];
$datos = [];
$formValido = false;

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
        //hace algo (CRUD BD)
        $formValido = true;
    }
}

// ********* INFO PARA EL TEMPLATE **********
$tituloHead = "Registro de usuario";
$content;

// ********* COMIENZO BUFFER **********
ob_start();

?>

<h1 class="text-center">Registro</h1>

<?php if ($formValido) { ?>
    <div class="alert alert-success text-center" style="max-width: 400px; margin: 25px auto;">
        ¡Registro exitoso!
    </div>
<?php } else if (isset($_POST['submit'])) { ?>
    <div class="alert alert-danger text-center" style="max-width: 400px; margin: 25px auto;">
        El formulario contiene errores.
    </div>
<?php } ?>

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
        <input type="password" class="form-control" id="password" name="password">
        <?php if (isset($errores['password'])) echo $errores['password']; ?>
    </div>

    <button class="btn btn-primary" type="submit" name="submit">Registrarse</button>
</form>

<?php

// ********* FIN BUFFER + LLAMADA AL TEMPLATE **********
$content = ob_get_contents();
ob_end_clean();
require("template.php");

?>