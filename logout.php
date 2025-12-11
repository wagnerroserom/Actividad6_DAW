
/* Procede a cerrar la sesión del usuario y lo dirige nuevamente al login */
<?php 
session_start();
session_destroy();
header('Location: login.php');
exit();
?>