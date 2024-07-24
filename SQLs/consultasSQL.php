<?php 
$dir = __DIR__;
require_once $dir . '/../SQLs/ConectarSQL.php';

function logError($message) {
    $date = date('Y-m-d H:i:s');
    error_log("[$date] $message\n", 3, './errores/Errores.log'); // Guardar el mensaje de error en un archivo de log
    error_log("[$date] $message\n", 3, '../log/Errores.log'); 
}

function encriptar_password($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}


/* Función para limpiar datos */
function clean_string($string) {
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
} 

function ejecutarSQL($sql, $params = []) {
    $conn = conectar();
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        logError("SQL: $sql | Error: " . $e->getMessage());
        return false;
    }
}

function insertSQL($tabla, $campos, $valores) {
    $sql = "INSERT INTO $tabla ($campos) VALUES($valores)";
    return ejecutarSQL($sql);
}

function updateSQL($tabla, $campos, $condicion) {
    $sql = "UPDATE $tabla SET $campos WHERE $condicion";
    return ejecutarSQL($sql);
}

function deleteSQL($tabla, $condicion) {
    $sql = "DELETE FROM $tabla WHERE $condicion";
    return ejecutarSQL($sql);
}



?>