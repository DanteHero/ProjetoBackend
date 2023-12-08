<?php
session_start();
include_once 'db.php';

if (!isset($_SESSION["login"])) {
    header("location: index.php");
    exit();
}

$login = $_SESSION["login"];

// Consulta para obter os dados do usuário a partir do banco de dados
$sql = "SELECT * FROM users WHERE login = '$login'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $nome = $row["nome"];
    $nomemat = $row["nomemat"];
    $datanasci = $row["datanasci"];
    $cpf = $row["cpf"];
    $tel_cel = $row["tel_cel"];
    $tel_fixo = $row["tel_fixo"];
    $sexo = $row["sexo"];
    $CEP = $row["CEP"];
} else {
    echo "Nenhum usuário encontrado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <style>
        body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

header {
    height: 65px;
    display: flex;
    justify-content: space-between;
    background-image: linear-gradient(to right, #660417, #12447b);
    box-shadow: 0 6px 6px 0 rgba(0, 0, 0, 0.61);
    width: 100%;
}

#logo_header {
    width: 230px;
    height: 70px;
    padding-top: 10px;
    text-align: center;
}

#logo_header_img {
    width: 180px;
}

#nav {
    display: flex;
    align-items: center;
    padding-right: 20px;
}

#area_cliente {
    padding: 15px;
    height: 54px;
    display: inline-flex;
    color: white;
    text-decoration: none;
    font-family: sans-serif;
}

#area_cliente:hover {
    background-color: rgba(0, 0, 0, 0.123);
}

#icone_area_cliente {
    height: 20px;
    width: 20px;
}

#text_area_cliente {
    padding-left: 5px;
}

.container {
    background-color: #fff;
    width: 50%;
    padding: 50px;
    border-radius: 10px;
    margin-top: 50px;
    border: 2px solid rgba(0, 0, 0, 0.26);
    box-shadow: 10px 10px rgba(0, 0, 0, 0.26);
    text-align: center;
}

h2 {
    color: #333;
}

label {
    font-weight: bold;
}

.negrito {
    font-weight: bold;
}

form {
    margin-top: 15px;
}

button {
    background-color: #12447b;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    margin-right: 10px;
    cursor: pointer;
}

button:hover {
    background-color: #0d253f;
}

#menu {
    display: flex;
    list-style: none;
    gap: 0.5rem;
    padding-top: 15px;
}

#menu a {
    display: block;
    padding: 15px;
    color: white;
    text-decoration: none;
    font-family: sans-serif;
}

#menu a:hover {
    color: white;
    background-color: rgba(0, 0, 0, 0.123);
}

#btn-mobile {
    display: none;
    color: white;
}

#btn-mobile:hover {
    background-color: rgba(0, 0, 0, 0.123);
}

/* Navbar responsivo */
@media (max-width: 1020px) {
    header {
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #660417;
        box-shadow: 0 6px 6px 0 rgba(0, 0, 0, 0.61);
    }

    #logo_header_img {
        width: 140px;
        padding-right: 10px;
    }

    #menu {
        display: block;
        position: absolute;
        width: 100%;
        top: 60px;
        right: 0px;
        background: rgba(236, 74, 74, 0.911);
        transition: 0.6s;
        z-index: 1000;
        height: 0px;
        visibility: hidden;
        overflow-y: hidden;
    }

    #nav.active #menu {
        height: 40%;
        visibility: visible;
        overflow-y: auto;
    }

    #menu a {
        padding: 1rem 0;
        margin: 0 1rem;
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
    }

    #menu a:hover {
        font-weight: bold;
    }

    #text_area_cliente {
        display: none;
    }

    #btn-mobile {
        display: flex;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        border: none;
        background: none;
        cursor: pointer;
        gap: 0.5rem;
        height: auto;
    }

    #hamburger {
        border-top: 2px solid;
        width: 20px;
    }

    #hamburger::after,
    #hamburger::before {
        content: '';
        display: block;
        width: 20px;
        height: 2px;
        background: currentColor;
        margin-top: 5px;
        transition: 0.3s;
        position: relative;
    }

    #nav.active #hamburger {
        border-top-color: transparent;
    }

    #nav.active #hamburger::before {
        transform: rotate(135deg);
    }

    #nav.active #hamburger::after {
        transform: rotate(-135deg);
        top: -7px;
    }
}

    </style>
</head>

<body>
<header>
            <a id="logo_header" href="index.html"><img id="logo_header_img"src="../img/telecall-logo-white.png"></a>
            <nav id="nav">
              
              <ul id="menu" role="menu">
                <li><a href="../2FA.html">2FA</a></li>
                <li><a href="../numero_mascara.html">Número Máscara</a></li>
                <li><a href="../google_verified.html">Google Verified Calls</a></li>
                <li><a href="../sms.html">SMS Programável</a></li>
              </ul>
              <a href="perfil.php" class="itens_menu" id="area_cliente">
                <svg id="icone_area_cliente"xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/></svg>
                <div id="text_area_cliente">Área do Cliente</div>
              </a>
            </nav>
    </header>

    <div class="container">
        <h2>Perfil do Usuário</h2>

        <label for="nome">Nome:</label><br>
        <span class="negrito"><?php echo $nome; ?></span><br>

        <label for="sexo">Sexo: </label><br>
        <span class="negrito"><?php echo $sexo; ?></span><br>

        <label for="login">Login: </label><br>
        <span class="negrito"><?php echo $login; ?></span><br>

        <label for="nomemat">Nome Materno: </label><br>
        <span class="negrito"><?php echo $nomemat; ?></span><br>

        <label for="cpf">CPF: </label><br>
        <span class="negrito"><?php echo $cpf; ?></span><br>

        <label for="datanasci">Data de Nascimento: </label><br>
        <span class="negrito"><?php echo $datanasci; ?></span><br>

        <label for="tel_cel">Celular: </label><br>
        <span class="negrito"><?php echo $tel_cel; ?></span><br>

        <label for="tel_fixo">Telefone Fixo: </label><br>
        <span class="negrito"><?php echo $tel_fixo; ?></span><br>

        <label for="CEP">Cep: </label><br>
        <span class="negrito"><?php echo $CEP; ?></span><br>

        <form action="consulta_usuario.php" method="POST">
            <button type="submit">Consultar Usuários</button>
        </form>

        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>

        <form action="altersenha.php" method="POST">
            <button type="submit">Alterar Senha</button>
        </form>
    </div>
</body>

</html>
