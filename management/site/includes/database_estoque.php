<?php
// Caminho absoluto para o arquivo de banco de dados estoque.db
$db_estoque_path = 'C:/Users/ld388/Desktop/management/estoque.db';

// Verifica se o arquivo de banco de dados existe
if (!file_exists($db_estoque_path)) {
    die('Erro: O arquivo de banco de dados estoque não foi encontrado.');
}

try {
    // Conectar ao banco de dados SQLite estoque
    $conn_estoque = new PDO("sqlite:$db_estoque_path");
    // Definir o modo de erro do PDO para exceção
    $conn_estoque->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro de conexão com o banco de dados estoque: ' . $e->getMessage());
}
?>
