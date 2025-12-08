/* Este archivo conecta a la base de datos MySQL */

$host = 'localhost';
$dbname = 'gestion_salones';
$usuario = 'root';
$clave = ''; // XAMPP no tiene contraseña por defecto en root

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>