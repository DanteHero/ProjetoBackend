<?php
// Inicializar a sessão (se já não estiver inicializada)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login (ou qualquer outra página desejada após o logout)
header("Location: ../login.html");
exit();
?>
