<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeuroDev - Bem-vindo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .carousel-item img {
            height: 450px;
            object-fit: cover;
        }
        .info-section {
            background-color: #f8f9fa;
            padding: 50px 15px;
        }
        .info-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .info-section p {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
        }
        footer p {
            margin: 0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
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


<!-- Banners Rotativos -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://via.placeholder.com/1200x450/007bff/ffffff?text=Bem-vindo+à+NeuroDev" class="d-block w-100" alt="Banner 1">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/1200x450/28a745/ffffff?text=Educação+Inclusiva+e+Atenta+às+Necessidades" class="d-block w-100" alt="Banner 2">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
    </button>
</div>

<!-- Informações -->
<div class="info-section text-center" id="clinica">
    <div class="container">
        <h2>Por que escolher a NeuroDev?</h2>
        <p>
            Na NeuroDev, acreditamos que cada criança tem um potencial único e oferecemos uma abordagem personalizada 
            para garantir que ela alcance o melhor de si. Nossa equipe multidisciplinar trabalha para oferecer suporte 
            pedagógico e terapêutico de qualidade.
        </p>
        <p>
            Proporcionamos um ambiente inclusivo, utilizando tecnologias modernas e práticas inovadoras para auxiliar no 
            desenvolvimento acadêmico, social e emocional de cada aluno.
        </p>

        <!-- Gráfico -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h3 class="text-center mb-4">Estatísticas sobre Transtornos de Neurodesenvolvimento</h3>
                <div class="progress mb-3">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">40% TDAH</div>
                </div>
                <div class="progress mb-3">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30% Autismo</div>
                </div>
                <div class="progress mb-3">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">20% Dislexia</div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">10% Outros</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center">
    <div class="container">
        <p>&copy; 2024 NeuroDev. Todos os direitos reservados.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
