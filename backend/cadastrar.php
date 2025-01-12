<?php
    
    include("config.php");

    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if($nome != '' && $email!= '' && $senha != ''){
        try{
            $query = "SELECT COUNT(*) as total FROM usuarios WHERE email = ?";
            $stmt = $pdo->prepare($query);
    
            $stmt->execute([$email]);
    
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if($resultado['total'] < 1){
                $sql = "INSERT INTO usuarios(nome,email,senha) VALUES (?,?,?)";
                $stmt = $pdo->prepare($sql);
    
                $stmt->execute([$nome,$email,$senha]);
    
                header("Location: ../frontend/lista_de_usuarios/index.html");
            }else {
                echo "O email ja está cadastro no sistema!";
            }
    
            
        }catch(PDOException $e){
            echo "Erro ao cadastrar usuario: ".$e->getMessage();
        }
    }else{
        echo "Falha ao cadastrar usuário, alguma informações importantes não foram fornecidas!";
    }
    
    

    function emailExiste(){
        try{
            $sql = "SELECT COUNT(*) as total FROM usuarios WHERE email = ?";
            $stmt = $pdo->prepare($sql);
    
            $stmt->execute([$email]);
    
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if($resultado >= 1){
                return true;
            }else{
                return false;
            }  

        }catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }

?>