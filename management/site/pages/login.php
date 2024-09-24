<?php
session_start();
include '../includes/header.php';
include '../includes/database_clientes.php'; // Conecta ao banco de dados clientes

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparar a consulta SQL para buscar o cliente pelo email
    $query = "SELECT * FROM clientes WHERE email = :email";
    $stmt = $conn_clientes->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar se o cliente foi encontrado e se a senha está correta
    if ($cliente && password_verify($senha, $cliente['senha'])) {
        $_SESSION['cliente_id'] = $cliente['id'];
        $_SESSION['cliente_nome'] = $cliente['nome'];
        header('Location: home.php'); // Redirecionar após o login
        exit();
    } else {
        echo "<p>Email ou senha incorretos.</p>";
    }
}
?>

<h1>Login</h1>
<form method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>
    <button type="submit">Entrar</button>
</form>

<?php include '../includes/footer.php'; ?>
