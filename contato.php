<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - NeuroDev</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .contact-header {
            background-color: #007bff;
            color: white;
            padding: 50px 0;
            text-align: center;
        }
        .contact-info {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .form-section {
            padding: 30px;
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
<header class="contact-header">
    <h1>Entre em Contato</h1>
    <p>Estamos aqui para ajudar. Entre em contato conosco usando o formulário abaixo ou pelas informações fornecidas.</p>
</header>

<!-- Main Content -->
<div class="container my-5">
    <div class="row">
        <!-- Informações de Contato -->
        <div class="col-md-4">
            <div class="contact-info">
                <h3>Informações da Clínica</h3>
                <p><strong>Endereço:</strong> Rua Exemplo, 123, Centro, São Paulo - SP</p>
                <p><strong>Telefone:</strong> (11) 1234-5678</p>
                <p><strong>E-mail:</strong> contato@neurodev.com.br</p>
                <p><strong>Horário de Atendimento:</strong> Segunda a Sexta, das 9h às 18h</p>
            </div>
        </div>

        <!-- Formulário de Contato -->
        <div class="col-md-8">
            <div class="form-section">
                <h3>Envie uma Mensagem</h3>
                <form action="enviar_contato.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="assunto" class="form-label">Assunto</label>
                        <input type="text" class="form-control" id="assunto" name="assunto" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem</label>
                        <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                </form>
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
