<?php
session_start();
require_once('../includes/conexao.php'); // Certifique-se de que o caminho da conexão está correto

// Verificar se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $prazo = $_POST['prazo'];
    $usuario_id = $_SESSION['user_id'];

    // Preparar a query para inserir a tarefa
    $sql = "INSERT INTO tarefas (titulo, descricao, prazo, usuario_id) 
            VALUES ('$titulo', '$descricao', '$prazo', '$usuario_id')";

    // Verificar se a query foi executada com sucesso
    if ($conn->query($sql) === TRUE) {
        header("Location: minhas_tarefas.php"); // Redireciona para a página de tarefas
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Fechar a conexão com o banco
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Tarefa</title>
    <link rel="stylesheet" href="../src/css/style.css"> <!-- Caminho para o CSS -->
</head>
<body>
    <div class="container">
        <h2>Criar Nova Tarefa</h2>

        <!-- Formulário para criação de tarefa -->
        <form action="criar_tarefa.php" method="POST">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" required>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" required></textarea>

            <label for="prazo">Prazo:</label>
            <input type="datetime-local" name="prazo" required>

            <button type="submit">Criar Tarefa</button>
        </form>
    </div>
</body>
</html>
