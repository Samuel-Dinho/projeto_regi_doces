<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

if (isset($_GET['idProduto'])) {
    $idProduto = $_GET['idProduto'];

    // Consulta para pegar os dados do produto
    $sqlquery = "SELECT pd.*, d.Departamento
    FROM projeto_individual.produtos AS pd
    JOIN projeto_individual.departamento AS d
    ON pd.idDepartamento = d.idDepartamento WHERE idProduto = ?";
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
