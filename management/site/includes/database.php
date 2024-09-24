<?php
// Caminho para o banco de dados do carrinho
$db_carrinho_path = 'C:/Users/ld388/Desktop/management/site/pages/database_carrinho.db';

// Verifica se o arquivo de banco de dados do carrinho existe
if (!file_exists($db_carrinho_path)) {
    die('Erro: O arquivo de banco de dados do carrinho não foi encontrado.');
}

try {
    // Conectar ao banco de dados SQLite carrinho
    $conn_carrinho = new PDO("sqlite:$db_carrinho_path");
    $conn_carrinho->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro de conexão com o banco de dados do carrinho: ' . $e->getMessage());
}

// Caminho para o banco de dados de vendas
$db_vendas_path = 'C:/Users/ld388/Desktop/management/site/pages/vendas.db';

if (!file_exists($db_vendas_path)) {
    die('Erro: O arquivo de banco de dados de vendas não foi encontrado.');
}

try {
    // Conectar ao banco de dados SQLite vendas
    $conn_vendas = new PDO("sqlite:$db_vendas_path");
    $conn_vendas->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro de conexão com o banco de dados de vendas: ' . $e->getMessage());
}

// Caminho para o banco de dados de produtos (estoque)
$db_estoque_path = 'C:/Users/ld388/Desktop/management/estoque.db';

if (!file_exists($db_estoque_path)) {
    die('Erro: O arquivo de banco de dados de estoque não foi encontrado.');
}

try {
    // Conectar ao banco de dados SQLite estoque
    $conn_estoque = new PDO("sqlite:$db_estoque_path");
    $conn_estoque->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro de conexão com o banco de dados de estoque: ' . $e->getMessage());
}
?>
