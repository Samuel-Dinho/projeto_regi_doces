<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    // Processar outros dados do formulário
    $idProduto = $_POST['prod_id_produto'];
    $nameProduto = $_POST['nameProduto'];
    $departamento = $_POST['departamento'];
    $preco = $_POST['preco'];
    $rotulo = $_POST['rotulo'];
    $dest_path = $_POST['arquivo'];
    $descricao = $_POST['descricao'];
    $destaque = $_POST['destaque'];
    $carrosel = $_POST['carrosel'];
    $quantidade = $_POST['quantidade'];
    
    // Aqui você pode atualizar os outros campos no banco de dados
    $sql = "UPDATE projeto_final.produto SET prod_nome_produto='$nameProduto', categoria_idcategoria='$departamento', prod_preco='$preco', prod_descricao='$descricao',prod_rotulo='$rotulo', prod_arquivo='$dest_path', prod_destaque='$destaque', prod_carrosel='$carrosel', prod_quantidade = '$quantidade' WHERE prod_id_produto='$idProduto'";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php');
    } else {
        echo "Erro ao atualizar o produto: " . mysqli_error($conn);
    }
}

// Fechar conexão
mysqli_close($conn);
?>
