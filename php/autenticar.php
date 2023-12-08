<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "telecall";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Receber os dados do formulário
$pergunta = $_POST['pergunta'];
$resposta = $_POST['resposta'];

// Validar a resposta (você pode adicionar mais validações conforme necessário)
if (empty($resposta)) {
    die("Por favor, preencha a resposta.");
}

// Mapear a pergunta escolhida para o campo correspondente no banco de dados
$campoNoBanco = "";
switch ($pergunta) {
    case 'a':
        $campoNoBanco = "nomemat";
        break;
    case 'b':
        $campoNoBanco = "datanasci";
        break;
    case 'c':
        $campoNoBanco = "cep";
        break;
    default:
        die("Pergunta inválida.");
}

// Consultar o banco de dados para verificar se a resposta está correta
$query = "SELECT * FROM users WHERE $campoNoBanco = '$resposta'";
$result = $conn->query($query);

// Verificar se a consulta foi bem-sucedida
if ($result === false) {
    die("Erro na consulta SQL: " . $conn->error);
}

// Verificar se há resultados
if ($result->num_rows > 0) {
    echo "Resposta correta. Logado com sucesso!";
    header("location: ../index.html");
    // Aqui você pode redirecionar o usuário para a próxima página ou realizar outras ações necessárias
} else {
    echo "Resposta incorreta. Por favor, tente novamente.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>