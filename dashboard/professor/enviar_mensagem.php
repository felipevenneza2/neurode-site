<?php
session_start();

// Verificar se o usuário está logado e se é um professor
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] != 'professor') {
    header("Location: http://localhost/AutismoProjeto2/login/login.php");
    exit();
}

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

// Verificar se a mensagem foi enviada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mensagem'])) {
    $mensagem = $conn->real_escape_string($_POST['mensagem']);
    $remetente_id = $_SESSION['user_id'];

    // Enviar mensagem para o administrador (ou qualquer outro destinatário específico)
    $sql = "INSERT INTO comunicacao (remetente_id, destinatario_id, mensagem, data)
            VALUES ($remetente_id, 1, '$mensagem', NOW())"; // Aqui, 1 seria o ID do administrador

    if ($conn->query($sql) === TRUE) {
        header("Location: comunicacao.php");
        exit();
    } else {
        echo "Erro ao enviar mensagem: " . $conn->error;
    }
}
?>
