<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

header('Content-Type: application/json'); // Define o cabeçalho como JSON

if (isset($_GET['prod_id_produto'])) {
    // Valida o ID do produto
    $idProduto = intval($_GET['prod_id_produto']); // Converte para inteiro
    
    // Consulta para pegar os dados do produto
    $sqlquery = "SELECT pd.*, d.categoria
                 FROM projeto_final.produto AS pd
                 JOIN projeto_final.categoria AS d
                 ON pd.categoria_idcategoria = d.idcategoria
                 WHERE prod_id_produto = ?";
    $stmt = $conn->prepare($sqlquery);
    
    if ($stmt) {
        $stmt->bind_param("i", $idProduto);
        $stmt->execute();
        $result = $stmt->get_result();
        $produto = $result->fetch_assoc();
        
        if ($produto) {
            // Retorna os dados do produto em formato JSON
            echo json_encode($produto);
        } else {
            // Retorna um erro se o produto não for encontrado
            echo json_encode(['error' => 'Produto não encontrado']);
        }
        
        $stmt->close();
    } else {
        // Retorna um erro se houver um problema na consulta SQL
        echo json_encode(['error' => 'Erro na preparação da consulta']);
    }
} else {
    // Retorna um erro se o ID do produto não for passado na URL
    echo json_encode(['error' => 'ID do produto não especificado']);
}

mysqli_close($conn);
?>
