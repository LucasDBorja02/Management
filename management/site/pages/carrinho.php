<?php
session_start();
include '../includes/header.php';
include '../includes/database_estoque.php';  // Conexão com o banco de dados de produtos (estoque.db)
include '../includes/database.php';  // Conexão com o banco de dados do carrinho (database_carrinho.db)

// Adicionar produto ao carrinho
if (isset($_GET['produto_id'])) {
    $produto_id = $_GET['produto_id'];

    try {
        // Consultar o produto pelo ID no banco de dados de produtos (estoque.db)
        $query = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $conn_estoque->prepare($query);
        $stmt->execute([$produto_id]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produto) {
            // Adicionar o item ao banco de dados do carrinho
            $query_insert = "INSERT INTO carrinho (produto_id, nome, preco, quantidade) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn_carrinho->prepare($query_insert);
            $stmt_insert->execute([$produto['id'], $produto['nome'], $produto['preco_venda'], 1]);

            echo "<p>Produto adicionado ao carrinho com sucesso!</p>";
        }
    } catch (PDOException $e) {
        echo "Erro ao adicionar ao carrinho: " . $e->getMessage();
    }
}

// Remover produto do carrinho
if (isset($_GET['remover_id'])) {
    $remover_id = $_GET['remover_id'];

    try {
        // Remover o item do banco de dados do carrinho
        $query_delete = "DELETE FROM carrinho WHERE produto_id = ?";
        $stmt_delete = $conn_carrinho->prepare($query_delete);
        $stmt_delete->execute([$remover_id]);

        echo "<p>Produto removido do carrinho com sucesso!</p>";
    } catch (PDOException $e) {
        echo "Erro ao remover produto do carrinho: " . $e->getMessage();
    }
}

// Consultar os itens no carrinho
try {
    $query_carrinho = "SELECT * FROM carrinho";
    $stmt_carrinho = $conn_carrinho->prepare($query_carrinho);
    $stmt_carrinho->execute();
    $itens_carrinho = $stmt_carrinho->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar itens do carrinho: " . $e->getMessage();
}
?>

<h1>Carrinho de Compras</h1>
<?php if (!empty($itens_carrinho)): ?>
    <ul>
        <?php foreach ($itens_carrinho as $item): ?>
            <li>
                <?php echo $item['nome']; ?> - Quantidade: <?php echo $item['quantidade']; ?> - R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?>
                <a href="?remover_id=<?php echo $item['produto_id']; ?>" class="btn btn-danger">Remover</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="checkout.php" class="btn btn-primary">Finalizar Compra</a>
<?php else: ?>
    <p>O carrinho está vazio.</p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
