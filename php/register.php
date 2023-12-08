<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $permission_level = $_POST["permission_level"];
    $nome = $_POST["nome"];
    $nomemat = $_POST["nomemat"];
    $datanasci = $_POST["datanasci"];
    $cpf = $_POST["cpf"];
    $tel_cel = $_POST["tel_cel"];
    $tel_fixo = $_POST["tel_fixo"];
    $sexo = $_POST["sexo"];
    $cep = $_POST["CEP"];

    $sql = "INSERT INTO users (login, senha, permission_level, nome, nomemat, datanasci, cpf, tel_cel, tel_fixo, sexo, cep) VALUES ('$login', '$senha', '$permission_level', '$nome', '$nomemat', '$datanasci', '$cpf', '$tel_cel', '$tel_fixo', '$sexo', '$cep')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro bem-sucedido. <a href='../login.html'>Faça login</a>";
    } else {
        echo "Erro ao registrar: " . $conn->error;
    }
}
?>

