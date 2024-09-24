<?php 
include '../includes/header.php'; 
include '../includes/database_estoque.php'; // Conecta ao banco de dados estoque

try {
    // Consultar todos os produtos
    $query = "SELECT * FROM produtos";
    $stmt = $conn_estoque->prepare($query);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($produtos)) {
        echo "<p>Nenhum produto encontrado.</p>";
    }
} catch (PDOException $e) {
    echo "Erro ao buscar produtos: " . $e->getMessage();
}
?>

<div class="container mt-4">
    <h1 class="text-center">Lista de Produtos</h1>
    <div class="row">
        <?php if (!empty($produtos)): ?>
            <?php foreach ($produtos as $produto): ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produto['nome']; ?></h5>
                            <p class="card-text">R$ <?php echo number_format($produto['preco_venda'], 2, ',', '.'); ?></p>
                            <p class="card-text">Quantidade disponível: <?php echo $produto['quantidade']; ?></p>
                            <a href="carrinho.php?produto_id=<?php echo $produto['id']; ?>" class="btn btn-primary">Adicionar ao Carrinho</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
