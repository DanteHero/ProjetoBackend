<?php
session_start();
include_once 'db.php';
require('fpdf/fpdf.php');

if (!isset($_SESSION["login"])) {
    header("location: index.html");
    exit();
}

// Verifica se o usuário tem permissão de administrador
if ($_SESSION["permission_level"] != 2) {
    header("location: ../consulta_error.html");
    exit();
}

$search = ""; // Inicializa a variável de pesquisa

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $search = mysqli_real_escape_string($conn, $_POST["search"]);
}

$sql = "SELECT * FROM users WHERE nome LIKE '%$search%'";
$result = $conn->query($sql);

// Verifica se a consulta foi bem-sucedida
if ($result === false) {
    echo "Erro na consulta: " . $conn->error;
    exit();
}

// Função para atualizar os dados do usuário
function atualizarUsuario($conn, $id, $nome, $login, $permissao, $nomemat, $datanasci, $cpf, $tel_cel, $tel_fixo, $sexo, $CEP) {
    $sql = "UPDATE users SET nome='$nome', login='$login', permission_level='$permissao', nomemat='$nomemat', datanasci='$datanasci', cpf='$cpf', tel_cel='$tel_cel', tel_fixo='$tel_fixo', sexo='$sexo', CEP='$CEP' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        
    } else {
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">




    <title>Consulta de Usuários</title>

    <style>
      
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-top: 20px;
        }

        form {
            margin: 20px;
        }

        label {
            margin-right: 10px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
            margin-top: 20px;
            background-color: #fff;
            border: 2px solid rgba(0, 0, 0, 0.26);
            box-shadow: 10px 10px rgba(0, 0, 0, 0.26);
            text-align: center;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #12447b;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        #editar {
            display: inline-block;
            background-color: #12447b;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #0d253f;
        }

        /*////  header ------------------------------------------------------------- ////*/

header {
    height: 65px;
    display: flex;
    justify-content: space-between;/*alinha as divs */
    background-image: linear-gradient(to right, #660417, #12447b);
    box-shadow: 0 6px 6px 0 rgba(0, 0, 0, 0.61);    
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
}

#area_cliente {
    padding:15px ;
    height: 54px;
    display: inline-flex;
    color:white;
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
    padding-left:5px ;
  
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

/*-------------------------navbar responsivo ------------------------------ */

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

#footer {
      margin-top: 25%;
      padding: 2%;
      background-image: linear-gradient(to right, #660417, #12447b);
      color: white;
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
    <h2>Consulta de Usuários</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="search">Pesquisar por nome:</label>
        <input type="text" name="search" value="<?php echo $search; ?>">
        <input type="submit" value="Pesquisar">
    </form>

    <div>
    <?php
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nome</th><th>Login</th><th>Permissão</th><th>Nome Materno</th><th>Data de Nascimento</th><th>CPF</th><th>Telefone Celular</th><th>Telefone Fixo</th><th>Sexo</th><th>CEP</th><th>Ações</th></tr>";
    while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["nome"] . "</td>";
    echo "<td>" . $row["login"] . "</td>";
    echo "<td>" . $row["permission_level"] . "</td>";
    echo "<td>" . $row["nomemat"] . "</td>";
    echo "<td>" . $row["datanasci"] . "</td>";
    echo "<td>" . $row["cpf"] . "</td>";
    echo "<td>" . $row["tel_cel"] . "</td>";
    echo "<td>" . $row["tel_fixo"] . "</td>";
    echo "<td>" . $row["sexo"] . "</td>";
    echo "<td>" . $row["CEP"] . "</td>";
    echo '<td><button id="editar" onclick="editarUsuario(' . $row["id"] . ', \'' . $row["nome"] . '\', \'' . $row["login"] . '\', \'' . $row["permission_level"] . '\', \'' . $row["nomemat"] . '\', \'' . $row["datanasci"] . '\', \'' . $row["cpf"] . '\', \'' . $row["tel_cel"] . '\', \'' . $row["tel_fixo"] . '\', \'' . $row["sexo"] . '\', \'' . $row["CEP"] . '\')">Editar</button></td>';
    echo '<td><button id="excluir" onclick="excluirUsuario(' . $row["id"] . ')">Excluir</button></td>';
    echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum usuário encontrado.";
}
?>


        <div id="modalEditar" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="fecharModalEditar()">&times;</span>
                <h3>Editar Usuário</h3>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="editId" id="editId">
                    <label for="editNome">Nome:</label>
                    <input type="text" name="editNome" id="editNome" required><br>

                    <label for="editLogin">Login:</label>
                    <input type="text" name="editLogin" id="editLogin" required><br>

                    <label for="editPermissao">Permissão:</label>
                    <input type="text" name="editPermissao" id="editPermissao" required><br>

                    <label for="editNomemat">Nome Materno:</label>
                    <input type="text" name="editNomemat" id="editNomemat" required><br>

                    <label for="editDatanasci">Data de Nascimento:</label>
                    <input type="text" name="editDatanasci" id="editDatanasci" required><br>

                    <label for="editCpf">CPF:</label>
                    <input type="text" name="editCpf" id="editCpf" required><br>

                    <label for="editTelCel">Telefone Celular:</label>
                    <input type="text" name="editTelCel" id="editTelCel" required><br>

                    <label for="editTelFixo">Telefone Fixo:</label>
                    <input type="text" name="editTelFixo" id="editTelFixo" required><br>

                    <label for="editSexo">Sexo:</label>
                    <input type="text" name="editSexo" id="editSexo" required><br>

                    <label for="editCEP">CEP:</label>
                    <input type="text" name="editCEP" id="editCEP" required><br>


                    <input type="submit" value="Salvar">
                </form>
            </div>
        </div>

        <script>
            function formatarCPF(editCpf) {
        // Formatar CPF: XXX.XXX.XXX-XX
        editCpf = editCpf.replace(/\D/g, ''); // Remove caracteres não numéricos
        editCpf = editCpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        return editCpf;
    }

    function formatarTelefone(editTelCel) {
        // Formatar telefone: (XX) XXXX-XXXX
        editTelCel = editTelCel.replace(/\D/g, ''); // Remove caracteres não numéricos
        editTelCel = editTelCel.replace(/(\d{2})(\d{4,5})(\d{4})/, '($1) $2-$3');
        return editTelCel;
    }

    function formatarTelefone(editTelFixo) {
        // Formatar telefone: (XX) XXXX-XXXX
        editTelFixo = editTelFixo.replace(/\D/g, ''); // Remove caracteres não numéricos
        editTelFixo = editTelFixo.replace(/(\d{2})(\d{4,5})(\d{4})/, '($1) $2-$3');
        return editTelFixo;
    }

    function formatarCEP(editCEP) {
        // Formatar CEP: XXXXX-XXX
        editCEP = editCEP.replace(/\D/g, ''); // Remove caracteres não numéricos
        editCEP = editCEP.replace(/(\d{5})(\d{3})/, '$1-$2');
        return editCEP;
    }

        // Formatar os campos antes de exibi-los no formulário de edição
        document.getElementById("editCpf").value = formatarCPF(editCpf);
      

            function editarUsuario(id, nome, login, permissao, nomemat, datanasci, cpf, tel_cel, tel_fixo, sexo, CEP) {
            console.log(id, nome, login, permissao, nomemat, datanasci, cpf, tel_cel, tel_fixo, sexo, CEP);
            document.getElementById("editId").value = id;
            document.getElementById("editNome").value = nome;
            document.getElementById("editLogin").value = login;
            document.getElementById("editPermissao").value = permissao;
            document.getElementById("editNomemat").value = nomemat;
            document.getElementById("editDatanasci").value = datanasci; 
            document.getElementById("editCpf").value = cpf;
            document.getElementById("editTelCel").value = tel_cel; 
            document.getElementById("editTelFixo").value = tel_fixo; 
            document.getElementById("editSexo").value = sexo; 
            document.getElementById("editCEP").value = CEP;

            document.getElementById("modalEditar").style.display = "block";
    }

    function fecharModalEditar() {
        document.getElementById("modalEditar").style.display = "none";
    }

    function excluirUsuario(id) {
        if (confirm("Tem certeza que deseja excluir este usuário?")) {
            window.location.href = 'excluir_usuario.php?id=' + id;
        }
    }

    function gerarPDF() {
            var doc = new jsPDF();

            // Adiciona uma tabela ao PDF
            doc.autoTable({
                head: [
                    <?php
                    // Cria um array PHP com os cabeçalhos da tabela
                    $headers = array("ID", "Nome", "Login", "Permissão", "Nome Materno", "Data de Nascimento", "CPF", "Telefone Celular", "Telefone Fixo", "Sexo", "CEP", "Ações");
                    echo json_encode($headers);
                    ?>
                ],
                body: <?php echo json_encode($result->fetch_all(MYSQLI_ASSOC)); ?> // Usa o resultado diretamente
            });

            // Salva o PDF com um nome específico, por exemplo, 'registros.pdf'
            doc.save('registro.pdf');
        }
</script>


        <?php
        // Processa o formulário de edição
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editId"])) {
            $editId = mysqli_real_escape_string($conn, $_POST["editId"]);
            $editNome = mysqli_real_escape_string($conn, $_POST["editNome"]);
            $editLogin = mysqli_real_escape_string($conn, $_POST["editLogin"]);
            $editPermissao = mysqli_real_escape_string($conn, $_POST["editPermissao"]);
            $editNomemat = mysqli_real_escape_string($conn, $_POST["editNomemat"]);
            $editDatanasci = mysqli_real_escape_string($conn, $_POST["editDatanasci"]);
            $editCpf = mysqli_real_escape_string($conn, $_POST["editCpf"]);
            $editTelCel = mysqli_real_escape_string($conn, $_POST["editTelCel"]);
            $editTelFixo = mysqli_real_escape_string($conn, $_POST["editTelFixo"]);
            $editSexo = mysqli_real_escape_string($conn, $_POST["editSexo"]);
            $editCEP = mysqli_real_escape_string($conn, $_POST["editCEP"]);
    

            atualizarUsuario($conn, $editId, $editNome, $editLogin, $editPermissao, $editNomemat, $editDatanasci, $editCpf, $editTelCel, $editTelFixo, $editSexo, $editCEP);
        }
        ?>
    </div>
    <footer id="footer">
    <div id="itens_footer">
      <h6>© Copyright 2023 Gabriel Ferreira e Luiz Gustavo.</h6>
    </div>
  </footer>
</body>

</html>