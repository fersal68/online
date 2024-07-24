<?php
// Obtener el directorio del archivo actual 
$dir = __DIR__;
//  usando la ruta relativa
require_once $dir . '/../SQLs/consultasSQL.php';
//require_once $dir . '/../SQLs/ConectarSQL.php';
// la funcion de errores se encuentra en consultasSQL.php
$formulario = clean_string($_POST['formulario']);
// Verificar si se ha enviado el formulario
if (isset($_POST['formulario']) && $_POST['formulario'] === 'RegistracionFrom') {
    $fecha_hoy = date('Y-m-d');
    // Limpiar los datos de entrada
    $user = clean_string($_POST['regname']);
    $pass = clean_string(encriptar_password($_POST['regpass']));
    $nombre = clean_string($_POST['regfullname'] . ' ' . $_POST['reglastname']);
    $direccion = clean_string($_POST['regdir']);
    $telefono = clean_string($_POST['regphone']);
    $email = clean_string($_POST['regemail']);
    $dni = clean_string($_POST['regdni']);
    // Verificar si las variables no están vacías
    if (!empty($dni) && !empty($nombre) && !empty($telefono) && !empty($email) && !empty($direccion) && !empty($user) && !empty($pass)) {
        // Verificar si el usuario o el email ya existen // quite por ahora el control de mail, solo lo hace por usuario
        //$checkUserSQL = "SELECT * FROM prodes.usuarios WHERE USUARIO = ? OR EMAIL = ?";
        //$checkUserStmt = ejecutarSQL($checkUserSQL, [$user, $email]);
        $checkUserSQL = "SELECT * FROM prodes.usuarios WHERE USUARIO = ? ";
        $checkUserStmt = ejecutarSQL($checkUserSQL, [$user ]);
        if ($checkUserStmt && $checkUserStmt->rowCount() > 0) {
            logError($formulario."- El usuario o el email ya están registrados: Usuario: $user, Email: $email");
            echo 'user_exists'; // Cambia este mensaje para diferenciar el error
        } else {
            // Proceder con la inserción
            $campos = "USUARIO, PASSWORD, FECHA_ALTA, NOMBRE, DIRECCION, TELEFONO, EMAIL, DNI";
            $valores = "?, ?, ?, ?, ?, ?, ?, ?";
            $params = [$user, $pass, $fecha_hoy, $nombre, $direccion, $telefono, $email, $dni];

            if (ejecutarSQL("INSERT INTO prodes.usuarios ($campos) VALUES($valores)", $params)) {
                echo 'success';
            } else {
                echo 'insert_error'; // Cambia este mensaje para diferenciar el error
                logError($formulario."- Error en la inserción de datos");
            }
        }
    } else {
        logError($formulario. '- Faltan campos requeridos en el formulario de registro.');
        echo 'missing_fields';
    }
} else {
    logError($formulario -'- Formulario no enviado.');
    echo 'Error';
}
?>