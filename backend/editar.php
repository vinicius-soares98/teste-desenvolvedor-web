<?php
    include("config.php");
    session_start();

    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    if(isset($_GET['id'])){
        $id =htmlspecialchars( $_GET['id']);


        try{
            $buscarID = "SELECT id FROM usuarios WHERE id = ?";
            $stmt = $pdo->prepare($buscarID);
            $stmt->execute([$id]);
            $idUsuario = $stmt->fetchColumn();

            $buscarNome = "SELECT nome FROM usuarios WHERE id = ?";
            $stmt = $pdo->prepare($buscarNome);
            $stmt->execute([$id]);
            $nomeUsuario = $stmt->fetchColumn();

            $buscarEmail = "SELECT email FROM usuarios WHERE id = ?";
            $stmt = $pdo->prepare($buscarEmail);
            $stmt->execute([$id]);
            $emailUsuario = $stmt->fetchColumn();

        }catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }else{
        $id = " ID não fornecido";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/cadastro/cadastro.css">
    <title>Edição de usuários</title>
    
</head>
<body>
    <header>
        <h1>Atualizar usuário</h1>
    </header>
    <main>
        <div class="dados">
            <div class="usuario-header">
                <h2>Atualizar dados</h2>
            </div>
            <form class="usuario" action="./update_query.php" method="post" id="form">
                <input type="hidden" placeholder="ID" name="idUsuario" id="idUsuario" class="id" required value = <?= $idUsuario?>>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <input type="text" placeholder="Nome" name="nome" id="nome" required value = <?= $nomeUsuario?>>
                <input type="email" placeholder="E-mail" name="email" required id="email" value = <?= $emailUsuario?> >
                <input type="password" placeholder="Senha" name="senha" required minlength="6" id="senha">
                <input type="password" placeholder="Repetir Senha" required minlength="6" id="repetir-senha">
                <button class="btn-cadastrar" type="submit">Atualizar</button>
                <span class="status"></span>
            </form>
        </div>
    </main>

    <script>
        formCadastro = document.getElementById("form")
        btnCadastrar = document.querySelector(".btn-cadastrar")
        nome = document.getElementById("nome")
        email = document.getElementById("email")
        senha = document.getElementById("senha")
        repetirSenha = document.getElementById("repetir-senha")
        testando = document.querySelector(".status")

        formCadastro.addEventListener("submit", function(event){
            event.preventDefault()
            if(nome.value.length <=0 || email.value.length <= 0){
                testando.textContent = 'Existem campos em branco!'
                testando.style.display = 'block'
                testando.style.color = 'red'
            }
            else{
                validarSenhasFrontEnd()
            }    
        })
        senha.addEventListener('click', function(){
            testando.style.display = 'none'
        })

        function validarSenhasFrontEnd(){
            if(senha.value.length >=6){
                if(senha.value === repetirSenha.value){
                    testando.style.color = 'green'
                    testando.style.display = 'block'
                    testando.textContent = 'Cadastrando...'
                    formCadastro.submit()
                    testando.style.display = 'none'
                    nome.value = ''
                    email.value = ''
                    senha.value = ''
                    repetirSenha.value = ''
                }
                else{
                    testando.textContent = 'As senhas não coincidem!'
                    testando.style.display = 'block'
                    testando.style.color = 'red'
                }
            }
            else{
                testando.style.display = 'block'
                testando.textContent = 'A sua senha deve possuir ao menos 6 digitos!'
            }
    
        }
    </script>
</body>
</html>