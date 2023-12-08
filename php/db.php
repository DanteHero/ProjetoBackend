<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "telecall";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$login = $_SESSION["login"];
$permission_level = $_SESSION["permission_level"];
$senha = isset($_SESSION["senha"]) ? $_SESSION["senha"] : "";
$permission_level = $_SESSION["permission_level"];
$nome = isset($_SESSION["nome"]) ? $_SESSION["nome"] : "";
$nomemat = isset($_SESSION["nomemat"]) ? $_SESSION["nomemat"] : "";
$datanasci = isset($_SESSION["datanasci"]) ? $_SESSION["datanasci"] : "";
$cpf = isset($_SESSION["cpf"]) ? $_SESSION["cpf"] : "";
$tel_cel = isset($_SESSION["tel_cel"]) ? $_SESSION["tel_cel"] : "";
$tel_fixo = isset($_SESSION["tel_fixo"]) ? $_SESSION["tel_fixo"] : "";
$sexo = isset($_SESSION["sexo"]) ? $_SESSION["sexo"] : "";
$cep = isset($_SESSION["cep"]) ? $_SESSION["cep"] : "";

?>
