<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

if (isset($_GET['idcategoria'])) {
    $idcategoria = $_GET['idcategoria'];
    
    // Consulta para pegar os dados do produto
    $sqlquery = "SELECT * from projeto_final.categoria WHERE idcategoria  = ?";
    $stmt = $conn->prepare($sqlquery);
    $stmt->bind_param("i", $idcategoria);
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();

    // Retornar os dados do produto em formato JSON
    echo json_encode($produto);

    $stmt->close();
}

mysqli_close($conn);
?>
