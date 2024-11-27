<?php
// Iniciar a sessão
session_start();

// Conectar ao banco de dados
$host = "localhost";
$user = "root"; 
$password = "";
$dbname = "autismo_plataforma"; // Alterado para 'autismo_plataforma'

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter o ID do usuário logado
if (!isset($_SESSION['user_id'])) {
    die("Usuário não autenticado.");
}
$usuario_id = $_SESSION['user_id'];

// Variável para mensagens de erro ou sucesso
$erro = '';
$sucesso = '';

// Processar o envio de mensagens via AJAX
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mensagem'], $_POST['destinatario_id'])) {
    $mensagem = $_POST['mensagem'];
    $destinatario_id = $_POST['destinatario_id'];

    // Verificar se o campo de mensagem não está vazio
    if (!empty($mensagem)) {
        // Inserir a mensagem no banco de dados
        $sql = "INSERT INTO mensagens (remetente_id, destinatario_id, mensagem, data_envio) 
                VALUES ('$usuario_id', '$destinatario_id', '$mensagem', NOW())";
        
        if ($conn->query($sql)) {
            $sucesso = "Mensagem enviada com sucesso!";
        } else {
            $erro = "Erro ao enviar a mensagem: " . $conn->error;
        }
    } else {
        $erro = "Por favor, digite uma mensagem.";
    }
}

// Carregar as mensagens do banco de dados
$sql_mensagens = "SELECT m.mensagem, m.data_envio, u.nome AS nome_remetente
                  FROM mensagens m
                  JOIN usuarios u ON m.remetente_id = u.id
                  WHERE m.destinatario_id = '$usuario_id' 
                  OR m.remetente_id = '$usuario_id' 
                  ORDER BY m.data_envio ASC";
$result = $conn->query($sql_mensagens);

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mensagens entre usuários">
    <title>Mensagens</title>
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="first-column">
            <h2 class="title title-primary">Área de Mensagens</h2>
            <p class="description description-primary">Envie e visualize suas mensagens aqui.</p>
            <a href="../dashboard/professor/index.php" class="btn btn-primary">Voltar ao Dashboard</a>
        </div>
        <div class="second-column">
            <!-- Exibir mensagem de erro ou sucesso -->
            <?php if ($erro): ?>
                <div class="alert alert-error">
                    <strong>Erro: </strong> <?php echo $erro; ?>
                </div>
            <?php endif; ?>
            <?php if ($sucesso): ?>
                <div class="alert alert-success">
                    <strong>Sucesso: </strong> <?php echo $sucesso; ?>
                </div>
            <?php endif; ?>

            <!-- Formulário de envio de mensagem -->
            <form id="form-mensagem" method="POST">
                <textarea name="mensagem" id="mensagem" placeholder="Escreva sua mensagem..." required></textarea><br>
                <label for="destinatario_id">Enviar para: </label>
                <select name="destinatario_id" id="destinatario_id" required>
                    <?php
                    // Listar os usuários para quem a mensagem pode ser enviada (agora usando autismo_plataforma)
                    $conn = new mysqli($host, $user, $password, $dbname);  // Conectar novamente a autismo_plataforma
                    $sql_usuarios = "SELECT id, nome FROM usuarios";
                    $usuarios_result = $conn->query($sql_usuarios);
                    while ($user = $usuarios_result->fetch_assoc()) {
                        if ($user['id'] != $usuario_id) { // Evita que o usuário se envie mensagens
                            echo "<option value='{$user['id']}'>{$user['nome']}</option>";
                        }
                    }
                    ?>
                </select><br>
                <button type="submit" class="btn btn-second">Enviar</button>
            </form>

            <!-- Exibir as mensagens -->
            <h3>Mensagens</h3>
            <div id="mensagens-container" class="mensagens-container">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="mensagem">
                        <strong><?php echo $row['nome_remetente']; ?>:</strong>
                        <p><?php echo $row['mensagem']; ?></p>
                        <small><?php echo date('d/m/Y H:i', strtotime($row['data_envio'])); ?></small>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <!-- Incluir jQuery e o script AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Enviar a mensagem sem recarregar a página
            $('#form-mensagem').submit(function(e) {
                e.preventDefault(); // Evita o envio tradicional do formulário

                // Coletar os dados do formulário
                var mensagem = $('#mensagem').val();
                var destinatario_id = $('#destinatario_id').val();

                // Enviar os dados via AJAX
                $.ajax({
                    url: 'mensagens.php', // URL do próprio arquivo
                    method: 'POST',
                    data: {
                        mensagem: mensagem,
                        destinatario_id: destinatario_id
                    },
                    success: function(response) {
                        // Atualizar as mensagens
                        $('#mensagens-container').load('mensagens.php #mensagens-container');
                        $('#mensagem').val(''); // Limpar o campo de mensagem
                    }
                });
            });
        });
    </script>
</body>
</html>
