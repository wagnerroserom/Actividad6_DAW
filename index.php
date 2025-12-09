session_start();

// Si hay alguna sesión activa, se redirige según el rol
if (isset($_SESSION['id_usuario'])) {
    if ($_SESSION['tipo'] === 'admin'){
        header('Location: admin/dashboard.php');
        exit();
    }
}

// Si no hay sesión activa, se va a login
header('Location: login.php');
exit();
?>