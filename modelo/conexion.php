<?php
// modelo/conexion.php
$host = 'sql10.freesqldatabase.com';
$dbname = 'sql10830031';
$username = 'sql10830031';
$password = 'bFpJy9NAEt';

try {
    $conex = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $username, $password);
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>