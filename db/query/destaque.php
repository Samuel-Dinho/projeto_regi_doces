<?php
 require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

// Perform query
$sql = "select * from projeto_individual.produtos where destaque = 1";
  // Free result set

  $result = mysqli_query($conn, $sql);


  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Ajusta para remover barra inicial se existir
        
        // Monta o caminho correto
        $imagePath = "../imagens/" . $row['arquivo']; // Ajuste conforme necessário

        // Verifica a extensão do arquivo
            echo "
            <div class='grid-template'>
                <div class='grid'>
                    <h2>" . htmlspecialchars($row['nameProduto']) . "</h2>
                    <a href='#' class='grid-item'>
                        <img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row['nameProduto']) . "' srcset=''>
                    </a>
                    <p>R$: " . number_format($row['preco'], 2, ',', '.') . "</p>
                </div>
            </div>";
       
    }
} else {
    echo "Nenhum produto encontrado.";
}
  mysqli_close($conn);

 
?>
