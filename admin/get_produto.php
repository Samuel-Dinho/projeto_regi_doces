<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

if (isset($_GET['prod_id_produto'])) {
    $idProduto = $_GET['prod_id_produto'];
    
    // Consulta para pegar os dados do produto
    $sqlquery = "SELECT pd.*, d.categoria
    FROM projeto_final.produto AS pd
    JOIN projeto_final.categoria AS d
    ON pd.categoria_idcategoria = d.idcategoria WHERE prod_id_produto  = ?";
    $stmt = $conn->prepare($sqlquery);
    $stmt->bind_param("i", $idProduto);
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();

    // Retornar os dados do produto em formato JSON
    echo json_encode($produto);

    $stmt->close();
}

mysqli_close($conn);
?>
