<?php
// Incluindo a conexão com o banco de dados
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

// Consulta para obter produtos com carrossel ativo
$sql = "SELECT * FROM projeto_final.produto WHERE prod_carrosel = 1";
$result = mysqli_query($conn, $sql);

// Verifica se há produtos para exibir
if ($result->num_rows > 0) {
    echo "<div id='carouselExampleIndicators' class='carousel slide' data-bs-ride='carousel'>";

    // Itens do carrossel
    echo "<div class='carousel-inner'>";

    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $imagePath = "../imagens/" . $row['prod_arquivo'];
        //$imagePathWebP = str_replace('.jpg', '.webp', $imagePath); // Assumindo que você tem as imagens WebP
        $activeClass = $i == 0 ? "active" : "";

        echo "
        <div class='carousel-item $activeClass'>
            <picture>
           
                <img src='" . htmlspecialchars($imagePath) . "' 
                     sizes='(max-width: 500px) 500px, (min-width: 601px) 100px' 
                     class='d-block w-100' 
                     alt='" . htmlspecialchars($row['prod_nome_produto']) . "' 
                     loading='lazy'
                     style='height:250px;object-fit: contain;'>
              
            </picture>
            <div class='carousel-caption fixed-caption d-block'>
                <h5>" . htmlspecialchars($row['prod_nome_produto']) . "</h5>
                <p>R$: " . number_format($row['prod_preco'], 2, ',', '.') . "</p>
                <a href='pages/produto.php#" . htmlspecialchars($row['prod_id_produto']) . "' class='btn btn-primary'>Ver Produto</a>
            </div>
        </div>";
        $i++;
    }

    echo "</div>";

    // Botões de navegação (Previous e Next)
    echo "
    <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='prev'>
        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
        <span class='visually-hidden'>Previous</span>
    </button>
    <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='next'>
        <span class='carousel-control-next-icon' aria-hidden='true'></span>
        <span class='visually-hidden'>Next</span>
    </button>";

    // Indicadores (bolinhas de navegação)
    echo "<div class='carousel-indicators'>";
    for ($i = 0; $i < $result->num_rows; $i++) {
        echo "<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='" . $i . "' " . ($i == 0 ? "class='active'" : "") . " aria-current='true' aria-label='Slide " . ($i + 1) . "'></button>";
    }
    echo "</div>";
    echo "</div>"; // Fecha o carrossel
}

mysqli_close($conn);
?>


<link rel="stylesheet" href="../../style/style.css">