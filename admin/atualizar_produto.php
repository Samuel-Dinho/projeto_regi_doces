<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    // Processar outros dados do formulário
    $idProduto = $_POST['idProduto'];
    $nameProduto = $_POST['nameProduto'];
    $departamento = $_POST['departamento'];
    $preco = $_POST['preco'];
    $dest_path = $_POST['arquivo'];
    $descricao = $_POST['descricao'];
    $destaque = $_POST['destaque'];
    $carrosel = $_POST['carrosel'];
    
    // Aqui você pode atualizar os outros campos no banco de dados
    $sql = "UPDATE projeto_individual.produtos SET nameProduto='$nameProduto', idDepartamento='$departamento', preco='$preco', descricao='$descricao', arquivo='$dest_path', destaque='$destaque', carrosel='$carrosel' WHERE idProduto='$idProduto'";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php');
    } else {
        echo "Erro ao atualizar o produto: " . mysqli_error($conn);
    }
}

// Fechar conexão
mysqli_close($conn);
?>
