<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.html");
    exit();
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

echo "Bem-vindo, $login!<br>";
echo "Nível de permissão: $permission_level<br>";
header("location: ../index.html");

if ($permission_level == 1) {
    header("location: tela2fa.php");
} else {
    header("location: ../index.html");
}
?>
