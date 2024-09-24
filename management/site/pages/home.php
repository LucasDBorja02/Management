<?php include '../includes/header.php'; ?>

<div class="container mt-4">
    <div class="text-center">
        <h1 class="display-4">Bem-vindo à nossa Loja Online</h1>
        <?php if (isset($_SESSION['cliente_nome'])): ?>
            <p class="lead">Olá, <?php echo $_SESSION['cliente_nome']; ?>! Que bom ter você de volta.</p>
        <?php else: ?>
            <p class="lead">Aqui você encontra os melhores produtos!</p>
        <?php endif; ?>
        <a href="produtos.php" class="btn btn-primary btn-lg mt-3">Ver Produtos</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
