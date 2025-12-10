session_start();
require_once 'includes/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    if (empty($correo) || empty($contrasena)) {
        $error = 'Por favor, debe completar todos los campos.';
    }else{
        try {
            $stmt = $pdo->prepare("SELECT id_usuario, nombre_completo, correo, contrasena, tipo, activo FROM usuarios WHERE correo = ?");
            $stmt->execute([$correo]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                if ($usuario['activo'] == 1) {
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];
                    $_SESSION['nombre'] = $usuario['nombre_completo'];
                    $_SESSION['correo'] = $usuario['correo'];
                    $_SESSION['tipo'] = $usuario['tipo'];

                    // Se redirige según el tipo
                    if ($usuario['tipo'] === 'admin') {
                        header('Location: admin/dashboard.php');
                    } else {
                        header('Location: cliente/index.php');
                    }
                    exit();
                } else {
                    $error = 'Su cuenta está desactivada, por favor contacte al administrador.';
                }
                } else {
                    $error = 'El correo o la contraseña son incorrectos, por favor corriga.';
                }
            } catch (PDOException $e) {
                $error = 'Error al procesar la solicitud, por favor intentelo más tarde.';
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="es">
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Gestión de Salones</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 7px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 413px;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.7rem;
            color: #333;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: bold;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;       
        }
        button {
            width: 100%;
            padding: 0.7rem;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 4.5px;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover {
            background: #1a252f;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 1.2rem;
        }
        </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>