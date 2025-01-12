<?php 
    include("config.php");

    session_start();

    $id = $_POST['idUsuario'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    if($id != '' && $nome != '' && $email!= '' && $senha != ''){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                echo "Erro: Requisição inválida (token CSRF não correspondente).";
                exit();
            }
        
            if (isset($_POST['idUsuario']) && is_numeric($_POST['idUsuario'])) {
                $id = (int)$_POST['idUsuario'];
                
                
                try{
                    $query = "SELECT COUNT(*) as total FROM usuarios WHERE email = ? AND id != ? ";
                    $stmt = $pdo->prepare($query);
        
                    $stmt->execute([$email,$id]);
        
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
                    if($resultado['total'] < 1){

                        $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?" ;
                        $stmt = $pdo->prepare($sql);
                
                        $stmt->execute([$nome,$email,$senha,$id]);
                
                        
                        header("Location: ../frontend/lista_de_usuarios/index.html");
                    }
                    echo "O email fornecido ja está em uso!";

                }catch(PDOException $e){
                    echo "Erro: ".$e->getMessage();
                }
            } else {
                echo "Erro: ID inválido.";
                exit();
            }
        } else {
            echo "Método inválido.";
            exit();
        }
    }else{
        echo "Falha ao atualizar usuário, alguma informações importantes não foram fornecidas!";
    }


    
    

    

        

?>