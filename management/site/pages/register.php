<?php
include '../includes/header.php';
include '../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    $query = "INSERT INTO clientes (nome, cpf, endereco, telefone, email, senha) VALUES ('$nome', '$cpf', '$endereco', '$telefone', '$email', '$senha')";
    $conn->query($query);
    echo "<p>Cadastro realizado com sucesso!</p>";
}
?>

<h1>Registrar-se</h1>
<form method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required>
    <label for="cpf">CPF:</label>
    <input type="text" name="cpf" id="cpf" required>
    <label for="endereco">Endereço:</label>
    <input type="text" name="endereco" id="endereco" required>
    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" id="telefone" required>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>
    <button type="submit">Registrar</button>
</form>

<?php include '../includes/footer.php'; ?>
