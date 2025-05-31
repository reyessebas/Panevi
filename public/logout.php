<?php
// Inicia una nueva sesión o reanuda la sesión existente.
session_start();

// Elimina todas las variables de sesión.
session_unset();

// Destruye la sesión actual.
session_destroy();

// Redirige al usuario a la página de inicio (index.php).
header("Location: index.php");

// Finaliza la ejecución del script para asegurarse de que no se ejecute código adicional.
exit();