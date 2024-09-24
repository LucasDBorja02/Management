<?php
// Caminho para o arquivo de banco de dados clientes.db
$db_clientes_path = 'C:/Users/ld388/Desktop/management/clientes.db';

// Verifica se o arquivo de banco de dados existe
if (!file_exists($db_clientes_path)) {
    die('Erro: O arquivo de banco de dados clientes não foi encontrado.');
}

try {
    // Conectar ao banco de dados SQLite clientes
    $conn_clientes = new PDO("sqlite:$db_clientes_path");
    // Definir o modo de erro do PDO para exceção
    $conn_clientes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro de conexão com o banco de dados clientes: ' . $e->getMessage());
}
?>
