<?php

include "config.php";
$dsn = MySQL_BASE;
$username = MySQL_USER;
$password = MySQL_PASS;
//conexion a la 
try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    logError("Error en la conexión a la base de datos: " . $e->getMessage());
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}
?>
