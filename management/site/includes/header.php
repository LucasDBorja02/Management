<?php
// Verificar se a sessão já foi iniciada antes de iniciar uma nova sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar a sessão somente se ainda não estiver ativa
}

// Verificar se o usuário está logado
$is_logged_in = isset($_SESSION['cliente_id']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Online</title>
    <!-- Incluindo o Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluindo um estilo personalizado -->
    <link rel="stylesheet" href="/path/to/your/css/styles.css">
</head>
<body>
<header class="bg-primary text-white py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3">Minha Loja Online</h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link text-white" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="produtos.php">Produtos</a></li>
                    <!-- Verificar se o usuário está logado -->
                    <?php if ($is_logged_in): ?>
                        <li class="nav-item"><a class="nav-link text-white" href="#">Olá, <?php echo $_SESSION['cliente_nome']; ?></a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="logout.php">Sair</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="carrinho.php">Carrinho</a></li> <!-- Link para o carrinho -->
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link text-white" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="register.php">Registrar</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</header>
