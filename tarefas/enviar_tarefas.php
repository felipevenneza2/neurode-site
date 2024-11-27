<?php
// Conexão com o banco de dados e verificação de autenticação
require_once('../conexao.php'); // Atualizado para refletir a nova estrutura

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $prazo = $_POST['prazo'];
    $usuario_id = $_SESSION['user_id']; // Assumindo que a sessão está iniciada

    $sql = "INSERT INTO tarefas (titulo, descricao, prazo, usuario_id) 
            VALUES ('$titulo', '$descricao', '$prazo', '$usuario_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Tarefa criada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Tarefa</title>
    <link rel="stylesheet" href="../src/styles.css"> <!-- Caminho atualizado -->
</head>
<body>
    <div class="container">
        <form action="tarefas/enviar_tarefa.php" method="POST"> <!-- Caminho atualizado -->
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" required>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" required></textarea>

            <label for="prazo">Prazo:</label>
            <input type="datetime-local" name="prazo" required>

            <button type="submit">Enviar Tarefa</button>
        </form>
    </div>
</body>
</html>
