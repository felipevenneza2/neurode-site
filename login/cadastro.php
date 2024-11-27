<?php
// Conectar ao banco de dados
$host = "localhost";
$user = "root";
$password = "";
$dbname = "autismo_plataforma";

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Variável para mensagens de erro
$erro = "";

// Verificar envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo_usuario = $_POST['tipo_usuario'];
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
    $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : null;

    // Validação adicional
    if ($tipo_usuario === "professor" || $tipo_usuario === "admin") {
        if (!$cpf) {
            $erro = "CPF é obrigatório para professores e administradores.";
        }
    }
    if ($tipo_usuario === "aluno" && !$matricula) {
        $erro = "Matrícula é obrigatória para alunos.";
    }

    if (empty($erro)) {
        // Inserir no banco
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario, cpf, matricula) 
                VALUES ('$nome', '$email', '$senha', '$tipo_usuario', '$cpf', '$matricula')";
        if ($conn->query($sql) === TRUE) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cadastre-se para criar uma conta na plataforma.">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Primeira coluna com boas-vindas -->
        <div class="first-column">
            <h2 class="title title-primary">Crie sua conta</h2>
            <p class="description description-primary">Preencha as informações abaixo para se cadastrar.</p>
            <p class="description description-primary">Já tem uma conta?</p>
            <a href="login.php" class="btn btn-primary">Entrar</a>
        </div>

        <!-- Segunda coluna com formulário -->
        <div class="second-column">
            <h2 class="title title-second">Cadastrar novo usuário</h2>

            <!-- Formulário -->
            <form action="cadastro.php" method="POST" class="form">
                <!-- Campo Nome -->
                <label class="label-input" for="nome">
                    <i class="fas fa-user"></i>
                    <input id="nome" type="text" name="nome" placeholder="Nome Completo" required>
                </label>

                <!-- Campo Email -->
                <label class="label-input" for="email">
                    <i class="far fa-envelope"></i>
                    <input id="email" type="email" name="email" placeholder="E-mail" required>
                </label>

                <!-- Campo Senha -->
                <label class="label-input" for="senha">
                    <i class="fas fa-lock"></i>
                    <input id="senha" type="password" name="senha" placeholder="Senha" required>
                </label>

                <!-- Tipo de usuário -->
                <label class="label-input select-input" for="tipo_usuario">
                    <i class="fas fa-users"></i>
                    <select id="tipo_usuario" name="tipo_usuario" required onchange="toggleExtraFields()">
                        <option value="" selected disabled>Selecione o tipo de usuário</option>
                        <option value="professor">Professor</option>
                        <option value="aluno">Aluno</option>
                        <option value="admin">Administrador</option>
                    </select>
                </label>

                <!-- Campo CPF (exibido apenas para Professor/Admin) -->
                <label class="label-input extra-field" id="cpf-field" style="display: none;">
                    <i class="fas fa-id-card"></i>
                    <input id="cpf" type="text" name="cpf" placeholder="CPF (somente para professor/admin)">
                </label>

                <!-- Campo Matrícula (exibido apenas para Aluno) -->
                <label class="label-input extra-field" id="matricula-field" style="display: none;">
                    <i class="fas fa-id-badge"></i>
                    <input id="matricula" type="text" name="matricula" placeholder="Matrícula (somente para aluno)">
                </label>

                <!-- Botão de enviar -->
                <button type="submit" class="btn btn-second">Cadastrar</button>
            </form>
        </div>
    </div>

    <!-- Script Dinâmico -->
    <script>
        function toggleExtraFields() {
            const tipoUsuario = document.getElementById("tipo_usuario").value;
            document.getElementById("cpf-field").style.display = 
                (tipoUsuario === "professor" || tipoUsuario === "admin") ? "block" : "none";
            document.getElementById("matricula-field").style.display = 
                (tipoUsuario === "aluno") ? "block" : "none";
        }
    </script>
</body>
</html>
