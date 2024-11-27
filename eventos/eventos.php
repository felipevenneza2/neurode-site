<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
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
    die("Conexão falhou: " . $conn->connect_error);
}

// Criar evento
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['criar_evento'])) {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_evento = $_POST['data_evento'];

    // Inserir evento no banco de dados
    $sql = "INSERT INTO eventos (titulo, descricao, data_evento, usuario_id) VALUES ('$titulo', '$descricao', '$data_evento', '" . $_SESSION['user_id'] . "')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Evento criado com sucesso!');</script>";
    } else {
        echo "Erro: " . $conn->error;
    }
}

// Buscar eventos para o FullCalendar
$sql = "SELECT * FROM eventos ORDER BY data_evento ASC";
$result = $conn->query($sql);
$eventos = [];
while ($row = $result->fetch_assoc()) {
    $eventos[] = [
        'title' => $row['titulo'],
        'start' => $row['data_evento'],
        'description' => $row['descricao']
    ];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página de eventos">
    <title>Eventos</title>

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
    <div class="container">
        <div class="first-column">
            <h2 class="title title-primary">Gerenciar Eventos</h2>
            <p class="description description-primary">Crie e visualize seus eventos no calendário abaixo.</p>
            <a href="../dashboard/professor/index.php" class="btn btn-primary">Voltar ao Dashboard</a>
        </div>

        <div class="second-column">
            <!-- Formulário para criar evento -->
            <form action="eventos.php" method="POST">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" required>

                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao" required></textarea>

                <label for="data_evento">Data do Evento</label>
                <input type="date" name="data_evento" id="data_evento" required>

                <button type="submit" name="criar_evento">Criar Evento</button>
            </form>

            <h3>Calendário de Eventos</h3>

            <!-- FullCalendar -->
            <div id="calendar"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar o FullCalendar
            $('#calendar').fullCalendar({
                events: <?php echo json_encode($eventos); ?>, // Passando os eventos para o FullCalendar
                eventRender: function(event, element) {
                    element.find('.fc-title').append("<br><span style='font-size: 12px; color: #555;'>"+event.description+"</span>");
                }
            });
        });
    </script>

</body>
</html>

<?php
$conn->close();
?>
