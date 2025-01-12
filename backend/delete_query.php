<?php 
    include("config.php");

    session_start();

    $id = $_POST['idUsuario'];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            echo "Erro: Requisição inválida (token CSRF não correspondente).";
            exit();
        }
    
        if (isset($_POST['idUsuario']) && is_numeric($_POST['idUsuario'])) {
            $id = (int)$_POST['idUsuario'];
            

            try{
                $sql = "DELETE FROM usuarios WHERE id = ?" ;
                $stmt = $pdo->prepare($sql);
        
                $stmt->execute([$id]);
                
                header("Location: ../frontend/lista_de_usuarios/index.html");
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