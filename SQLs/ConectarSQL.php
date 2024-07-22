<?php 
include "config.php";
function conectar() {
    $dsn = MySQL_BASE;
    $username = MySQL_USER;
    $password = MySQL_PASS;
    static $conn;
    if (!isset($conn)) {
        try {
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    return $conn;
}
?>