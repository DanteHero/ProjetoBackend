<?php
session_start();
include_once 'db.php';

if (!isset($_SESSION["login"])) {
    header("location: index.html");
    exit();
}

// Verifica se o usuário tem permissão de administrador
if ($_SESSION["permission_level"] != 2) {
    header("location: ../consulta_error.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    // Aqui você deve realizar a exclusão no banco de dados usando o ID fornecido
    $sql = "DELETE FROM users WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Exclusão bem-sucedida
        header("location: consulta_usuario.php");
        exit();
    } else {
        // Se houver um erro na exclusão, você pode redirecionar ou mostrar uma mensagem de erro
        echo "Erro na exclusão: " . $conn->error;
        exit();
    }
} else {
    // Se o ID não for fornecido, redireciona para alguma página de erro
    header("location: consulta_usuario.php");
    exit();
}
?>
