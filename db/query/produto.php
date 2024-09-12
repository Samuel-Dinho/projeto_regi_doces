<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

// Query para obter os departamentos distintos
$sql = "SELECT Distinct dp.categoria FROM projeto_final.produto as pd inner join projeto_final.categoria as dp where dp.idcategoria = pd.categoria_idcategoria order by dp.categoria";
$result = mysqli_query($conn, $sql);

if (isset($_GET['prod_id_produto'])) {
    
}
if ($result->num_rows > 0) {
    echo "<div class='departamento'>";
    echo "<a href='#' class='department-link' data-department=''>Todos</a>";
    while ($row = $result->fetch_assoc()) {
        echo "
            <a href='#' class='department-link' data-department='" . htmlspecialchars($row['categoria']) . "'>" . strtoupper(htmlspecialchars($row['categoria'])) . "</a>
        ";
    }
    echo "</div>";
} else {
    echo "Nenhuma Categoria encontrado.";
}

// Query para obter todos os produtos
echo "<div class='prod'>";
$sqlquery = "SELECT * FROM projeto_final.produto as pd inner join projeto_final.categoria as dp where dp.idcategoria = pd.categoria_idcategoria";
$resultQuery = mysqli_query($conn, $sqlquery);

if ($resultQuery->num_rows > 0) {
    while ($row2 = $resultQuery->fetch_assoc()) {
        $imagePath = "../imagens/" . htmlspecialchars($row2['prod_arquivo']); // Ajuste conforme necessário
        echo "
            <div name='" .  htmlspecialchars($row2['prod_id_produto']) . "' id='" .  htmlspecialchars($row2['prod_id_produto']) . "'class='product-item items-" . htmlspecialchars($row2['categoria']) . "'>
                <img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row2['prod_nome_produto']) . "'>
                <div class='info-prod'>
                    <h2>" . strtoupper(htmlspecialchars($row2['prod_nome_produto'])) . "</h2>
                    <p>R$: " . number_format($row2['prod_preco'], 2, ',', '.') . "</p>
                    <span><b>Descrição: </b>" . htmlspecialchars($row2['prod_descricao']) . "</span>
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

