<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

// Query para obter os departamentos distintos
$sql = "SELECT DISTINCT departamento FROM projeto_individual.produtos";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    echo "<div class='departamento'>";
    while ($row = $result->fetch_assoc()) {
        echo "
            <a href='#' class='department-link' data-department='" . htmlspecialchars($row['departamento']) . "'>" . strtoupper(htmlspecialchars($row['departamento'])) . "</a>
        ";
    }
    echo "</div>";
} else {
    echo "Nenhum Departamento encontrado.";
}

// Query para obter todos os produtos
echo "<div class='prod'>";
$sqlquery = "SELECT * FROM projeto_individual.produtos";
$resultQuery = mysqli_query($conn, $sqlquery);

if ($resultQuery->num_rows > 0) {
    while ($row2 = $resultQuery->fetch_assoc()) {
        $imagePath = "../imagens/" . htmlspecialchars($row2['arquivo']); // Ajuste conforme necessário
        echo "
            <div class='product-item items-" . htmlspecialchars($row2['departamento']) . "'>
                <img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row2['nameProduto']) . "'>
                <div class='info-prod'>
                    <h2>" . strtoupper(htmlspecialchars($row2['nameProduto'])) . "</h2>
                    <p>R$: " . number_format($row2['preco'], 2, ',', '.') . "</p>
                    <p>Descrição: " . htmlspecialchars($row2['descricao']) . "</p>
                    <button class='add-to-cart-btn'>
                        <span class='cart-icon'>🛒</span>
                        <span>Adicionar ao Carrinho</span>
                    </button>
                </div>
            </div>
        ";
    }
} else {
    echo "Nenhum produto encontrado.";
}
echo "</div>";

mysqli_close($conn);
?>
