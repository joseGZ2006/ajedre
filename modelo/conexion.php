
<?php
// test_db.php
$host = 'sql10.freesqldatabase.com';
$dbname = 'sql10830031';
$username = 'sql10830031';
$password = 'bFpJy9NAEt';

try {
    $conex = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $username, $password);
    echo "✅ Conexión exitosa a FreeSQLDatabase";
    
    // Prueba consulta
    $stmt = $conex->query("SELECT NOW() as fecha");
    $row = $stmt->fetch();
    echo "<br>📅 Fecha del servidor: " . $row['fecha'];
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>