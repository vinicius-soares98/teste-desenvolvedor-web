<?php

if (isset($_POST['criarBanco'])) {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";


    $conexao = new mysqli($servidor, $usuario, $senha);

    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    $nomeBanco = "lista_usuarios";


    $sql = "CREATE DATABASE IF NOT EXISTS $nomeBanco";

    if ($conexao->query($sql) === TRUE) {
        echo "Banco de dados '$nomeBanco' criado com sucesso! VOCÊ JA PODE FECHAR ESSA PÁGINA!";

        $conexao->select_db($nomeBanco);

        $criarTabela = "CREATE TABLE IF NOT EXISTS usuarios (id int AUTO_INCREMENT PRIMARY KEY, nome varchar(200) not null, email varchar(200) not null, senha varchar(200) not null) ";

        if ($conexao->query($criarTabela) === TRUE) {
            echo "<p>Tabela 'usuarios' criada com sucesso!</p>";
        } else {
            echo "<p>Erro ao criar a tabela: " . $conexao->error . "</p>";
        }

    } else {
        echo "Erro ao criar o banco de dados: " . $conexao->error;
    }

    $conexao->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
        }
        body{
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 10px;
        }
        button{
            padding: 10px 50px;
            background-color:#00a4ef;
            color: white;
            border: none;
            cursor:pointer;
        }
        button:hover{
            opacity: 80%;
        }
    </style>
    <title>Criar Banco</title>
</head>
<body>
    <form method = "POST">
        <button class="btn-Criar-banco" type ="submit" name ="criarBanco">Criar Banco de Dados</button>
    </form>

</body>
</html>