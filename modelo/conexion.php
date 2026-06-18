<?php
// modelo/conexion.php
$host = 'localhost';
$dbname = 'ajedrez'; // o el nombre de tu base de datos
$username = 'admin'; // o tu usuario
$password = '123456'; // o tu contraseña

try {
    $conex = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>