<?php
// Conectar ao banco de dados
$mysqli = new mysqli('localhost', 'root', '', 'autismo_plataforma');

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Inicializar as variáveis
$tarefas = [];

// Verificar se o ID do aluno está na sessão
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Obtém o ID do usuário da sessão
} else {
    $user_id = 1; // Defina um valor padrão caso não esteja logado (apenas para testes)
}

// Consultar tarefas do aluno
$result_tarefas = $mysqli->query("SELECT * FROM tarefas WHERE data_limite >= CURDATE() AND usuario_id = '$user_id' ORDER BY data_limite ASC");

if ($result_tarefas) {
    while ($row = $result_tarefas->fetch_assoc()) {
        $tarefas[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas - NeuroDev</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        /* Ajuste do estilo da sidebar */
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

        .banner {
            width: 100%;
            height: 300px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .banner img {
            width: 100%;
            height: auto;
        }

        .personalized-message {
            font-size: 18px;
            font-weight: bold;
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
                <h1 class="my-4">Tarefas Futuros</h1>

                <?php if (count($tarefas) > 0): ?>
                    <div class="row">
                        <?php foreach ($tarefas as $tarefa): ?>
                            <div class="col-md-4">
                                <div class="card card-custom">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($tarefa['nome']); ?></h5>
                                        <p class="card-text"><strong>Data Limite:</strong> <?php echo date('d/m/Y', strtotime($tarefa['data_limite'])); ?></p>
                                        <p class="card-text"><strong>Descrição:</strong> <?php echo htmlspecialchars($tarefa['descricao']); ?></p>
                                        <a href="tarefa_detalhes.php?id=<?php echo $tarefa['id']; ?>" class="btn btn-primary">Ver Detalhes</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Você não tem tarefas futuras.</p>
                <?php endif; ?>

                <br>
                <a href="./index.php" class="btn btn-secondary">Voltar para Início</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("main-content").classList.toggle("collapsed");
        }
    </script>
</body>
</html>
