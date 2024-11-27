<?php
session_start();

// Verificar se o usuário está logado e é administrador
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] != 'admin') {
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

// Verificar se os parâmetros foram enviados
if (isset($_GET['id']) && isset($_GET['tipo'])) {
    $id = intval($_GET['id']);
    $tipo_usuario = $_GET['tipo'];

    // Validar o tipo de usuário
    if (in_array($tipo_usuario, ['professor', 'aluno'])) {
        // Executar o DELETE com base no tipo
        $sql_delete = "DELETE FROM usuarios WHERE id = $id AND tipo_usuario = '$tipo_usuario'";

        if ($conn->query($sql_delete) === TRUE) {
            // Redirecionar para a página correspondente
            $redirect_page = ($tipo_usuario === 'professor') ? 'professores.php' : 'alunos.php';
            header("Location: $redirect_page");
            exit();
        } else {
            echo "Erro ao deletar $tipo_usuario: " . $conn->error;
        }
    } else {
        echo "Tipo de usuário inválido.";
    }
} else {
    echo "Parâmetros inválidos.";
}
?>
