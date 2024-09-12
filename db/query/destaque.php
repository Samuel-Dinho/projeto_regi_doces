<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

// Perform query to get featured products
$sql = "SELECT * FROM projeto_final.produto WHERE prod_destaque = 1";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    echo "<h2>Produtos em Destaque</h2>";
    echo "<div class='products-grid'>";

    while ($row = $result->fetch_assoc()) {
        // Monta o caminho correto da imagem
        $imagePath = "../imagens/" . htmlspecialchars($row['prod_arquivo']); // Ajuste conforme necessário

        // Exibe o produto
        echo "
            <div class='grid-item'>
                <a href='pages/produto.php#" . htmlspecialchars($row['prod_id_produto']) . "'>
                    <img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row['prod_nome_produto']) . "' class='product-image'>
                </a>
                <h2 class='product-title'>" . htmlspecialchars($row['prod_nome_produto']) . "</h2>
                <p class='product-price'>R$: " . number_format($row['prod_preco'], 2, ',', '.') . "</p>
                <button class='add-to-cart'>Adicionar ao Carrinho</button>
            </div>
        ";
    }

    echo "</div>"; // Fecha o container dos produtos
} else {
    echo "Nenhum produto encontrado.";
}

mysqli_close($conn);
?>