<?php
// Obtener el directorio del archivo actual 
$dir = __DIR__;
//  usando la ruta relativa
require_once $dir . '/../SQLs/consultasSQL.php';

$formulario = clean_string($_POST['formulario']);
logError("formulario: $formulario " );
// Verificar si se ha enviado el formulario
if (isset($_POST['formulario'])) {

    switch ($formulario) {
        case 'ModMiInfoForm':
            $modnombre = clean_string($_POST['modnombre']);
            $moddireccion = clean_string($_POST['moddireccion']);
            $modtelefono = clean_string($_POST['modtelefono']);
            $modemail = clean_string($_POST['modemail']);
            $id_usuario = clean_string($_POST['id_usuario']);
          
            $tabla = 'prodes.usuarios';
            $campos = "NOMBRE = ? , DIRECCION = ?, TELEFONO = ?, EMAIL = ?  ";
            $condicion= " ID = ? ";

            $sql =  "UPDATE $tabla SET $campos WHERE $condicion";
            $params = [$modnombre, $moddireccion, $modtelefono , $modemail, $id_usuario];
            $stmt = ejecutarSQL($sql, $params);
            if ($stmt) {
                echo 'success';
            } else {
                echo 'error';
                logError($formulario.'- Control Modificacion - Registro no modificado.');
            }
            break;

        case 'ModPassForm':
            $newpass = clean_string(encriptar_password($_POST['newpass']));
            $id_usuario = clean_string($_POST['id_usuario']);

            $tabla = 'prodes.usuarios';
            $campos = " PASSWORD = ?  ";
            $condicion= " ID = ? ";
    
            $sql =  "UPDATE $tabla SET $campos WHERE $condicion";
            $params = [$newpass, $id_usuario];
            $stmt = ejecutarSQL($sql, $params);
            if ($stmt) {
                 echo 'success';
            } else {
                 echo 'error';
                logError($formulario.'- Control Modificacion - no se cambio contraseña.');
            }
            break;    
            default:
            echo 'Formulario no reconocido.';
            logError($formulario.'- Formulario no reconocido');
            break;
    }
} else {
    echo 'Error';
    logError($formulario .'- Faltan campos requeridos en el formulario.');
}
?>