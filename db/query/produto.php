<?php

require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';


// Query para obter os departamentos distintos
$sql = "SELECT Distinct dp.categoria FROM projeto_final.produto as pd inner join projeto_final.categoria as dp where dp.idcategoria = pd.idcategoria order by dp.categoria";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    echo "<div id='depart' class='departamento'>";
    echo "<a href='#' class='department-link' data-department=''>Todos</a>";
    while ($row = $result->fetch_assoc()) {
        echo "
            <a href='#' class='department-link' data-department='" . htmlspecialchars($row['categoria']) . "'>" . strtoupper(htmlspecialchars($row['categoria'])) . "</a>
        ";
    }
    echo "</div>";
} else {
    echo "Nenhuma Categoria encontrada.";
}

// Query para obter todos os produtos
echo "<div class='prod'>";
$sqlquery = "SELECT * FROM projeto_final.produto as pd inner join projeto_final.categoria as dp where dp.idcategoria = pd.idcategoria";
$resultQuery = mysqli_query($conn, $sqlquery);

if ($resultQuery->num_rows > 0) {
    while ($row2 = $resultQuery->fetch_assoc()) {
        $imagePath = "../imagens/" . htmlspecialchars($row2['prod_arquivo']);
        echo "
        <div name='" . htmlspecialchars($row2['prod_id']) . "' id='" . htmlspecialchars($row2['prod_id']) . "' class='product-item items-" . htmlspecialchars($row2['categoria']) . "'>
            <div class='info-prod'>
                <form class='ajax-form' id='form-prod' method='post' action='../class/Carrinho.php'>
                    <h2>" . strtoupper(htmlspecialchars($row2['prod_nome'])) . "</h2>
                    <img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row2['prod_nome']) . "'>
                    <input type='hidden' name='imagePath' value='" . htmlspecialchars($imagePath) . "'>
                    <input type='hidden' name='imageAlt' value='" . htmlspecialchars($row2['prod_nome']) . "'>
                    <p>R$: " . number_format($row2['prod_preco'], 2, ',', '.') . "</p> <!-- Exibir o preço diretamente -->
                    <input type='hidden' name='disponibilidade' value='" . htmlspecialchars($row2['prod_quantidade']) . "'>
                    <p>Disponivel: " . htmlspecialchars($row2['prod_quantidade']) . "</p>
                    <span><b>Descrição: </b>" . htmlspecialchars($row2['prod_descricao']) . "</span>
                    <p>Rotulo: " . htmlspecialchars(($row2['prod_rotulo'])) . "</p>
                    <input type='hidden' name='item_id' value='" . htmlspecialchars($row2['prod_id']) . "'>
                    <input type='hidden' name='nomeProduto' value='" . htmlspecialchars($row2['prod_nome']) . "'>
                    <input type='hidden' name='valor' value='" . htmlspecialchars($row2['prod_preco']) . "'>
                    <input type='hidden' name='add_to_cart' value='enviado'>
                    <button onclick='addToCart()'' class='add-to-cart-btn' type='submit' name='add_to_cart'>
                        <span class='cart-icon'>🛒</span> Adicionar ao Carrinho
                    </button>
                </form>
            </div>
        </div>
        ";
    }
} else {
    echo "Nenhum produto encontrado.";
}
echo "</div>";

mysqli_close($conn);
