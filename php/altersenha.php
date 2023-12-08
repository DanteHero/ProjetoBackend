<?php
session_start();
include_once 'db.php';

if (!isset($_SESSION["login"])) {
    header("location: index.html");
    exit();
}

$login = $_SESSION["login"];
$permission_level = $_SESSION["permission_level"];
$mensagem = "";

// Verificar se o usuário tem permissão para alterar a senha (permission_level != 2)
if ($permission_level == 2) {
    header("location: ../senhaalter_error.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nova_senha = isset($_POST["nova_senha"]) ? $_POST["nova_senha"] : "";
    $confirmar_senha = isset($_POST["confirmar_senha"]) ? $_POST["confirmar_senha"] : "";

    if ($nova_senha === $confirmar_senha) {
        // Aviso: Não recomendado para ambientes de produção
        $sql = "UPDATE users SET senha='$nova_senha' WHERE login='$login'";

        if ($conn->query($sql) === TRUE) {
            $mensagem = "Senha alterada com sucesso!";
        } else {
            $mensagem = "Erro ao alterar senha: " . $conn->error;
        }
    } else {
        $mensagem = "As senhas não coincidem.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            display: block;
            background-color: #fff;
            width: 50%;
            padding: 20px; /* Reduzi o padding para um visual mais compacto */
            border-radius: 10px;
            position: relative;
            margin: auto;
            margin-top: 50px;
            border: 2px solid rgba(0, 0, 0, 0.26);
            box-shadow: 10px 10px rgba(0, 0, 0, 0.26);
            text-align: center;
            border: 1px solid #ddd; /* Adicionado uma borda */
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .back-button, input[type="submit"] {
            display: inline-block;
            background-color: #12447b;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .back-button:hover, input[type="submit"]:hover {
            background-color: #0d253f;
        }

        @media (max-width: 750px) {
            .container {
                display: block;
                background-color: rgba(255, 255, 255, 0.603);
                width: 100%;
                height: 100%;
                padding: 20px;
                border-radius: 0px;
                position: relative;
                margin: 0px;
                margin-top: 0px;
                border: none;
                box-shadow: none;
                text-align: center;
            }
        }
    </style>

    <title>Alterar Senha</title>
</head>

<body>
    <header>
        <a id="logo_header" href="index.html"><img id="logo_header_img"src="img/telecall-logo-white.png"></a>
        <nav id="nav">
              
            <ul id="menu" role="menu">
            <li><a href="2FA.html">2FA</a></li>
            <li><a href="numero_mascara.html">Número Máscara</a></li>
            <li><a href="google_verified.html">Google Verified Calls</a></li>
            <li><a href="sms.html">SMS Programável</a></li>
            </ul>
            <a href="php/perfil.php" class="itens_menu" id="area_cliente">
            <svg id="icone_area_cliente"xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/></svg>
            <div id="text_area_cliente">Área do Cliente</div>
            </a>
        </nav>
      </header>
    <div class="container">
        <h2>Alterar Senha</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nova_senha">Nova Senha:</label>
            <input type="password" name="nova_senha" required><br>

            <label for="confirmar_senha">Confirmar Senha:</label>
            <input type="password" name="confirmar_senha" required><br>

            <input type="submit" value="Alterar Senha">
            <a href="perfil.php" class="back-button">Voltar</a><br>
            <?php echo $mensagem; ?>
        </form>
    </div>
</body>

</html>
