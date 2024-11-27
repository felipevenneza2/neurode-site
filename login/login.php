<?php
session_start();

// Se o usuário já estiver logado, redireciona para a dashboard de acordo com o tipo de usuário
if (isset($_SESSION['user_id'])) {
    // Verifica o tipo de usuário e redireciona para a página adequada
    if ($_SESSION['tipo_usuario'] == 'admin') {
        header("Location: ../dashboard/admin/index.php");
    } elseif ($_SESSION['tipo_usuario'] == 'professor') {
        header("Location: ../dashboard/professor/index.php");
    } else {
        header("Location: ../dashboard/aluno/index.php");
    }
    exit();
}

// Conectar ao banco de dados
$host = "localhost";
$user = "root"; 
$password = "";
$dbname = "autismo_plataforma"; 

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados. Por favor, tente novamente mais tarde.");
}

// Variável para armazenar a mensagem de erro
$erro = "";

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);  // Filtra e-mail
    $senha = $_POST['senha']; // Senha

    // Consulta segura usando prepared statements
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificar a senha usando a função password_verify
        if (password_verify($senha, $user['senha'])) {
            // Login bem-sucedido
            $_SESSION['user_id'] = $user['id']; // Armazenar ID do usuário na sessão
            $_SESSION['user_name'] = $user['nome']; // Armazenar nome do usuário na sessão
            $_SESSION['tipo_usuario'] = $user['tipo_usuario']; // Armazenar tipo de usuário

            // Redireciona de acordo com o tipo de usuário
            if ($user['tipo_usuario'] == 'admin') {
                header("Location: ../dashboard/admin/index.php");
            } elseif ($user['tipo_usuario'] == 'professor') {
                header("Location: ../dashboard/professor/index.php");
            } else {
                header("Location: ../dashboard/aluno/index.php");
            }
            exit();
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Faça login para acessar sua conta.">
    <title>Login</title>
    <!-- Caminho correto do CSS, voltando para a pasta src -->
    <link rel="stylesheet" href="../src/css/style.css"> <!-- Caminho correto -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="first-column">
            <h2 class="title title-primary">Olá, amigo!</h2>
            <p class="description description-primary">Entre com suas informações para continuar.</p>
            <p class="description description-primary">Ainda não tem uma conta?</p>
            <a href="../login/cadastro.php" class="btn btn-primary">Cadastrar</a>
        </div>
        <div class="second-column">
            <h2 class="title title-second">Entrar na conta</h2>

            <!-- Exibir mensagem de erro se houver -->
            <?php if ($erro): ?>
                <div class="alert alert-danger">
                    <strong>Erro: </strong> <?php echo $erro; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="form">
                <label class="label-input" for="email">
                    <i class="far fa-envelope"></i>
                    <input id="email" type="email" name="email" placeholder="E-mail" required>
                </label>
                <label class="label-input" for="senha">
                    <i class="fas fa-lock"></i>
                    <input id="senha" type="password" name="senha" placeholder="Senha" required>
                </label>
                <a class="password" href="../redefinicao_senha/enviar-link.php">Esqueceu sua senha?</a>
                <button type="submit" class="btn btn-second">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>
