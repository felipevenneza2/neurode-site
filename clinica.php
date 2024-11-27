<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre a Clínica - NeuroDev</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #007bff;
            color: white;
            padding: 50px 0;
            text-align: center;
        }
        .mission-section, .values-section {
            margin-bottom: 30px;
        }
        .values-list {
            list-style: none;
            padding: 0;
        }
        .values-list li {
            margin-bottom: 10px;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            text-align: center;
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
                        <li><a class="dropdown-item" href="sobre-clinica.php">Clínica</a></li>
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
<header class="header">
    <h1>Sobre a Clínica NeuroDev</h1>
    <p>Transformando vidas através do cuidado e da educação especializada.</p>
</header>

<!-- Conteúdo Principal -->
<div class="container my-5">
    <div class="row">
        <!-- Imagem da Clínica -->
        <div class="col-md-6">
            <img src="https://via.placeholder.com/600x400" alt="Imagem da Clínica" class="img-fluid rounded">
        </div>
        <!-- Informações da Clínica -->
        <div class="col-md-6">
            <h2>Quem Somos</h2>
            <p>
                A Clínica NeuroDev é dedicada ao cuidado de crianças com transtornos de neurodesenvolvimento, 
                oferecendo suporte especializado para promover o aprendizado, a integração social e a autonomia. 
                Com uma equipe altamente qualificada e comprometida, nosso objetivo é proporcionar um ambiente acolhedor 
                e terapêutico para as famílias que confiam em nosso trabalho.
            </p>
        </div>
    </div>

    <!-- Missão, Visão e Valores -->
    <div class="mission-section my-5">
        <h2 class="text-center">Nossa Missão</h2>
        <p class="text-center">
            Oferecer cuidado especializado e educação inclusiva para crianças com transtornos de neurodesenvolvimento, 
            transformando desafios em oportunidades de crescimento.
        </p>
    </div>
    <div class="vision-section my-5">
        <h2 class="text-center">Nossa Visão</h2>
        <p class="text-center">
            Ser referência nacional no cuidado e desenvolvimento de crianças com necessidades especiais, 
            promovendo inclusão e transformação social.
        </p>
    </div>
    <div class="values-section my-5">
        <h2 class="text-center">Nossos Valores</h2>
        <ul class="values-list text-center">
            <li><strong>Empatia:</strong> Entendemos e respeitamos as necessidades de cada criança e sua família.</li>
            <li><strong>Compromisso:</strong> Dedicamos esforços constantes para oferecer o melhor cuidado.</li>
            <li><strong>Inclusão:</strong> Promovemos igualdade de oportunidades e aceitação.</li>
            <li><strong>Inovação:</strong> Buscamos sempre as melhores práticas e métodos terapêuticos.</li>
        </ul>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2024 NeuroDev. Todos os direitos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
