<?php
    include("config.php");


    try{
        $sql = "SELECT  id,nome,email FROM usuarios";
        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($usuarios);

    }catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
    }
?>