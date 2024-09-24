<?php
session_start();
include '../includes/header.php';
include '../includes/database.php';  // Conexão com o banco de dados do carrinho
include '../includes/database_estoque.php';  // Conexão com o banco de dados de estoque

// Sincronizar os itens do banco de dados de carrinho com a variável de sessão
try {
    $query_carrinho = "SELECT * FROM carrinho";
    $stmt_carrinho = $conn_carrinho->prepare($query_carrinho);
    $stmt_carrinho->execute();
    $itens_carrinho = $stmt_carrinho->fetchAll(PDO::FETCH_ASSOC);

    // Colocar os itens do banco de dados de carrinho na variável de sessão
    $_SESSION['carrinho'] = [];
    foreach ($itens_carrinho as $item) {
        $_SESSION['carrinho'][] = [
            'id' => $item['produto_id'],
            'nome' => $item['nome'],
            'preco' => $item['preco'],
            'quantidade' => $item['quantidade']
        ];
    }
} catch (PDOException $e) {
    echo "Erro ao buscar itens do carrinho: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar se o carrinho existe e não está vazio
    if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        $forma_pagamento = $_POST['forma_pagamento'];

        try {
            $conn_vendas->beginTransaction(); // Iniciar uma transação no banco de dados de vendas

            foreach ($_SESSION['carrinho'] as $item) {
                $produto_id = $item['id'];
                $nome_produto = $item['nome'];  // Nome do produto
                $quantidade = $item['quantidade'];
                $subtotal = $item['preco'] * $quantidade;

                // Inserir a venda no banco de dados de vendas, incluindo o nome do produto
                $query = "INSERT INTO vendas (produto_id, nome_produto, quantidade, total, forma_pagamento) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn_vendas->prepare($query);
                $stmt->execute([$produto_id, $nome_produto, $quantidade, $subtotal, $forma_pagamento]);

                // Atualizar o estoque do produto no banco de dados de estoque
                $update_query = "UPDATE produtos SET quantidade = quantidade - ? WHERE id = ?";
                $stmt = $conn_estoque->prepare($update_query);
                $stmt->execute([$quantidade, $produto_id]);
            }

            $conn_vendas->commit(); // Confirmar a transação
            unset($_SESSION['carrinho']); // Limpar o carrinho
            echo "<p>Compra finalizada com sucesso!</p>";

            // Limpar o banco de dados de carrinho
            $conn_carrinho->exec("DELETE FROM carrinho");
        } catch (PDOException $e) {
            $conn_vendas->rollBack(); // Reverter a transação em caso de erro
            echo "Erro ao finalizar a compra: " . $e->getMessage();
        }
    } else {
        echo "<p>O carrinho está vazio. Adicione itens ao carrinho antes de finalizar a compra.</p>";
    }
}
?>


<h1>Finalizar Compra</h1>

<!-- Exibir itens do carrinho antes de finalizar a compra -->
<?php if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])): ?>
    <h2>Itens no Carrinho</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_compra = 0;
            foreach ($_SESSION['carrinho'] as $item):
                $subtotal = $item['preco'] * $item['quantidade'];
                $total_compra += $subtotal;
            ?>
                <tr>
                    <td><?php echo $item['nome']; ?></td>
                    <td><?php echo $item['quantidade']; ?></td>
                    <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Total da Compra:</strong></td>
                <td><strong>R$ <?php echo number_format($total_compra, 2, ',', '.'); ?></strong></td>
            </tr>
        </tbody>
    </table>
<?php else: ?>
    <p>O carrinho está vazio.</p>
<?php endif; ?>

<!-- Formulário para finalizar a compra -->
<form method="POST">
    <label for="forma_pagamento">Forma de Pagamento:</label>
    <select name="forma_pagamento" id="forma_pagamento">
        <option value="Debito">Débito</option>
        <option value="Credito">Crédito</option>
        <option value="Pix">Pix</option>
        <option value="Dinheiro">Dinheiro</option>
    </select>
    <button type="submit">Finalizar</button>
</form>

<?php include '../includes/footer.php'; ?>
