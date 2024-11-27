<?php
// Conectar ao banco de dados
$mysqli = new mysqli('localhost', 'root', '', 'autismo_plataforma');

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Inicializar as variáveis
$user_id = 1; // ID do aluno, altere conforme necessário (idealmente será obtido da sessão)
$user_name = '';
$user_email = '';

// Verificar se o ID do aluno está na sessão (o login deve ter atribuído um ID)
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Obtém o ID do aluno da sessão
} else {
    // Caso não esteja logado, redirecionar para o login
    header("Location: ../login.php");
    exit;
}

// Consultar os dados do aluno
$result = $mysqli->query("SELECT nome, email FROM usuarios WHERE id = '$user_id' AND tipo_usuario = 'aluno' LIMIT 1");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row['nome'];
    $user_email = $row['email'];
}

// Atualizar as informações do aluno se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['nome'];
    $new_email = $_POST['email'];

    // Atualiza as informações no banco de dados
    $update_query = "UPDATE usuarios SET nome = '$new_name', email = '$new_email' WHERE id = '$user_id'";
    if ($mysqli->query($update_query) === TRUE) {
        echo "<script>alert('Perfil atualizado com sucesso!');</script>";
        // Atualiza as variáveis para refletir os novos dados
        $user_name = $new_name;
        $user_email = $new_email;
    } else {
        echo "<script>alert('Erro ao atualizar o perfil.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - NeuroDev</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
            padding-top: 20px;
            width: 250px;
            transition: width 0.3s ease;
        }

        .sidebar .nav-item {
            margin-bottom: 10px;
        }

        .sidebar .nav-link {
            font-size: 18px;
            color: #333;
        }

        .sidebar .nav-link:hover {
            background-color: #007bff;
            color: #fff;
        }

        .sidebar .nav-item.active .nav-link {
            background-color: #007bff;
            color: #fff;
        }

        .main-content {
            transition: margin-left 0.3s ease;
            margin-left: 250px;
            padding: 20px;
        }

        .main-content .container-fluid {
            padding-top: 20px;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            text-align: center;
        }

        .toggle-btn {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 25px;
            cursor: pointer;
            z-index: 1;
        }

        .card-custom {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="bg-light sidebar p-3" id="sidebar">
            <h2 class="text-center" id="site-name">NeuroDev</h2>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php"><i class="fas fa-tachometer-alt"></i> <span>Início</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../video_chamada/video_chamada.php"><i class="fas fa-video"></i> <span>Video Chamada</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./tarefas.php"><i class="fas fa-tasks"></i> <span>Tarefas</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../aluno/JOGODAVELHA/index.html"><i class="fas fa-gamepad"></i> <span>Jogos</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./eventos.php"><i class="fas fa-calendar"></i> <span>Eventos</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./perfil.php"><i class="fas fa-user"></i> <span>Perfil</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../logout.php"><i class="fas fa-sign-out-alt"></i> <span>Sair</span></a>
                </li>
            </ul>
        </div>

        <div class="main-content" id="main-content">
            <span class="toggle-btn" onclick="toggleSidebar()">&#9776;</span>

            <div class="container-fluid">
                <h1 class="my-4">Perfil de <?php echo htmlspecialchars($user_name); ?></h1>
                
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="card-title">Informações do Perfil</h5>
                        <p><strong>Nome:</strong> <?php echo htmlspecialchars($user_name); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($user_email); ?></p>

                        <hr>
                        <h5 class="card-title">Editar Perfil</h5>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($user_name); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user_email); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var mainContent = document.getElementById('main-content');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
        }
    </script>
</body>
</html>