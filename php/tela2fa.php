<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

form {
    background-color: #fff;
    width: 50%;
    padding: 50px;
    border-radius: 10px;
    position: relative;
    margin: auto;
    margin-top: 50px;
    border: 2px solid rgba(0, 0, 0, 0.26);
    box-shadow: 10px 10px rgba(0, 0, 0, 0.26);
    text-align: center;
}

label {
    display: block;
    margin-bottom: 10px;
    color: #333;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    box-sizing: border-box;
    border: 1px solid rgba(0, 0, 0, 0.26);
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #12447b;
    color: #fff;
    padding: 10px 15px;
    border: 1px solid rgba(0, 0, 0, 0.219);
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #0d253f;
}

@media (max-width: 750px) {
    form {
        width: 100%;
        height: 100%;
        padding: 20px;
        border-radius: 0px;
        margin: 0px;
        margin-top: 0px;
        border: none;
        box-shadow: none;
        text-align: center;
    }

    input[type="text"] {
        width: 100%;
    }
}</style>
</head>
<body>
    <form action="autenticar.php" method="post">
        <?php
            $perguntas = array(
                "a" => "Qual o nome da sua mãe?",
                "b" => "Qual a data do seu nascimento?",
                "c" => "Qual o CEP do seu endereço?"
            );
            $perguntaAleatoria = array_rand($perguntas);

            // Verifica se a pergunta é sobre a data de nascimento
            $isDataNascimento = ($perguntaAleatoria === "b");
        ?>
        <input type="hidden" name="pergunta" value="<?php echo $perguntaAleatoria; ?>">
        <label for="resposta"><?php echo $perguntas[$perguntaAleatoria]; ?></label>
        <br>
        <?php
            // Se a pergunta for sobre data de nascimento, use o tipo "date"
            if ($isDataNascimento) {
                echo '<input type="date" name="resposta" required><br>';
            } else {
                echo '<input type="text" name="resposta" required>';
            }
        ?>
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>