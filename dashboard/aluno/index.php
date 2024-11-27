<?php 
// Conectar ao banco de dados
$mysqli = new mysqli('localhost', 'root', '', 'autismo_plataforma');

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Inicializar as variáveis
$total_tarefas = 0;
$total_eventos = 0;
$total_jogos = 0;
$user_name = 'Aluno'; // Nome padrão caso o nome do aluno não seja encontrado

// Verificar se o ID do aluno está na sessão (o login deve ter atribuído um ID)
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Obtém o ID do usuário da sessão
} else {
    $user_id = 1; // Defina um valor padrão caso não esteja logado (apenas para testes)
}

// Consultar o nome do aluno
$result_nome = $mysqli->query("SELECT nome FROM usuarios WHERE id = '$user_id' AND tipo_usuario = 'aluno' LIMIT 1");
if ($result_nome && $result_nome->num_rows > 0) {
    $row = $result_nome->fetch_assoc();
    $user_name = $row['nome']; // Atribui o nome do aluno
} else {
    $user_name = 'Aluno não encontrado'; // Mensagem de erro caso o nome não seja encontrado
}

// Consultar o total de tarefas pendentes
$result_tarefas = $mysqli->query("SELECT COUNT(*) AS total FROM tarefas WHERE status = 'pendente' AND usuario_id = '$user_id'");
if ($result_tarefas) {
    $row = $result_tarefas->fetch_assoc();
    $total_tarefas = $row['total'];
}

// Consultar o total de eventos
$result_eventos = $mysqli->query("SELECT COUNT(*) AS total FROM eventos WHERE data_evento >= CURDATE() AND usuario_id = '$user_id'");
if ($result_eventos) {
    $row = $result_eventos->fetch_assoc();
    $total_eventos = $row['total'];
}

// Consultar o total de jogos
$result_jogos = $mysqli->query("SELECT COUNT(*) AS total FROM jogos WHERE usuario_id = '$user_id'");
if ($result_jogos) {
    $row = $result_jogos->fetch_assoc();
    $total_jogos = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - NeuroDev</title>
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

        .card-custom {
            margin-bottom: 20px;
        }

        .personalized-message {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .sidebar.collapsed #site-name {
            display: none;
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
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../../assets/img/banner2.jpeg" class="d-block w-100" alt="Banner 1">
                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <h1 class="my-4">Bem-vindo à NeuroDev, Aluno <?php echo htmlspecialchars($user_name); ?>!</h1>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-custom">
                            <div class="card-body">
                                <h5 class="card-title">Tarefas Pendentes</h5>
                                <p class="card-text"><?php echo $total_tarefas; ?> tarefa(s) pendente(s) para realizar.</p>
                                <a href="./tarefas.php" class="btn btn-primary">Ver Tarefas</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-custom">
                            <div class="card-body">
                                <h5 class="card-title">Eventos Futuros</h5>
                                <p class="card-text"><?php echo $total_eventos; ?> evento(s) futuro(s) programado(s).</p>
                                <a href="./eventos.php" class="btn btn-primary">Ver Eventos</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-custom">
                            <div class="card-body">
                                <h5 class="card-title">Jogos Disponíveis</h5>
                                <p class="card-text"><?php echo $total_jogos; ?> jogo(s) disponível(is) para você.</p>
                                <a href="../aluno/JOGODAVELHA/index.html" class="btn btn-primary">Ver Jogos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('main-content').classList.toggle('collapsed');
        }
    </script>
</body>
</html>