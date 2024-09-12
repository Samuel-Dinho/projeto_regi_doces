<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    // Processar outros dados do formulário
    $idCategoria = $_POST['idCategoria'];
    $categoria = $_POST['categoria'];
    var_dump($categoria,$idCategoria);
    
    // Aqui você pode atualizar os outros campos no banco de dados
    $sql = "UPDATE projeto_final.categoria SET categoria='$categoria' WHERE idcategoria='$idCategoria'";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php');
    } else {
        echo "Erro ao atualizar o produto: " . mysqli_error($conn);
    }
}

// Fechar conexão
mysqli_close($conn);
?>
