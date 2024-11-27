<?php
// Iniciar a sessão
session_start();
require_once('../includes/conexao.php'); // Conexão com o banco de dados

// Verificar se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$usuario_id = $_SESSION['user_id'];

// Variável para mensagens de erro ou sucesso
$erro = '';
$sucesso = '';

// Buscar as tarefas do usuário
$sql = "SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY prazo ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Tarefas</title>
    <link rel="stylesheet" href="../src/css/style.css"> <!-- Caminho para o CSS -->
</head>
<body>
    <div class="container">
        <h2>Minhas Tarefas</h2>

        <a href="criar_tarefa.php" class="btn btn-primary">Criar Nova Tarefa</a>

        <!-- Adicionando o link para voltar ao dashboard -->
        <a href="../dashboard/professor/index.php" class="btn btn-primary">Voltar ao Dashboard</a>

        <!-- Listar as tarefas -->
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Prazo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['prazo'])); ?></td>
                            <td>
                                <a href="editar_tarefa.php?id=<?php echo $row['id']; ?>">Editar</a> | 
                                <a href="excluir_tarefa.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Você não tem tarefas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
