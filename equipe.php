<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipe - NeuroDev</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .team-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 50px 0;
        }
        .team-card {
            margin: 15px 0;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .team-card img {
            object-fit: cover;
            height: 300px;
            border-radius: 15px 15px 0 0;
        }
        .team-card .card-body {
            text-align: center;
        }
        .container {
            flex: 1;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-top: auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">NeuroDev</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Início</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sobreDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sobre
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="sobreDropdown">
                        <li><a class="dropdown-item" href="clinica.php">Clínica</a></li>
                        <li><a class="dropdown-item" href="equipe.php">Equipe</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contato.php">Contato</a>
                </li>
            </ul>
            <div class="d-flex">
            <a href="login/login.php" class="btn btn-outline-light me-2">Login</a>
            <a href="login/cadastro.php" class="btn btn-light">Cadastro</a>
            </div>
        </div>
    </div>
</nav>


<!-- Header -->
<header class="team-header">
    <h1>Nossa Equipe</h1>
    <p>Profissionais qualificados dedicados ao desenvolvimento e bem-estar das crianças.</p>
</header>

<!-- Conteúdo Principal -->
<div class="container my-5">
    <div class="row justify-content-center">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card team-card">
                <img src="https://via.placeholder.com/300x400" alt="Psicopedagoga" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Maria Oliveira</h5>
                    <p class="card-text"><strong>Cargo:</strong> Psicopedagoga</p>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="card team-card">
                <img src="https://via.placeholder.com/300x400" alt="Psicóloga" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Joana Silva</h5>
                    <p class="card-text"><strong>Cargo:</strong> Psicóloga</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="card team-card">
                <img src="https://via.placeholder.com/300x400" alt="Terapeuta Ocupacional" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Lucas Souza</h5>
                    <p class="card-text"><strong>Cargo:</strong> Terapeuta Ocupacional</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2024 NeuroDev. Todos os direitos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
