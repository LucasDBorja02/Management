<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
session_unset();  // Remove todas as variáveis de sessão
session_destroy(); // Destroi a sessão

// Redirecionar corretamente usando uma URL ou rota relativa no servidor
header('Location: /pages/login.php');
exit();
