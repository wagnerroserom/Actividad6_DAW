session_start();
require_once '../includes/config.php';

// Verifica si hay sesión activa y si es admin 
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Gestión de Salones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }
        .container {
            max-width: 1250px;
            margin: 0 auto;
            padding: 25px;
        }
        header {
            background: #2c3e50;
            color: white;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 25px;
            border-radius: 9px;
        }
        nav a {
            display: inline-block;
            margin: 0 13px 13px 0;
            padding: 13px 17px;
            background: #34495e;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }
        nav a:hover {
            background: #1a252f;
        }
        .logout {
            display: inline-block;
            margin-top: 13px;
            padding: 9px 17px;
            background: #e77c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?> (Administrador)</h1>
        </header>

        <nav>
            <a href="gestion_salones.php">Gestionar Salones</a>
            <a href="gestion_reservas.php">Gestionar Reservas</a>
        </nav>
        <a href="../logout.php" class="logout">Cerrar Sesión</a>
    </div>
</body>
</html>