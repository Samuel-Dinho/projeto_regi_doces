<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';
$sql = "select * from projeto_individual.produtos where carrosel = 1";
  // Free result set

  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    
    $contador = 1;
    
    while ($row = $result->fetch_assoc()) {
        $imagePath = "../imagens/" . $row['arquivo']; // Ajuste conforme necessário
        
        if ($contador == 1){
            echo "<input class='carousel-open' type='radio' id='carousel-$contador' name='carousel' aria-hidden='true' checked='checked'>";
        }else{
            echo "<input class='carousel-open' type='radio' id='carousel-$contador' name='carousel' aria-hidden='true'>";
        }
        echo "<div class='carousel-item'> ";  
        echo " 
            <img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row['nameProduto']) . "' srcset=''>
            <div class='index'>
            <p>" . htmlspecialchars($row['nameProduto']) . "</p>

            <p>R$: " . number_format($row['preco'], 2, ',', '.') . "</p>
            </div>";

        echo "</div>";

        $contador ++;
        
    }
    
}
mysqli_close($conn);


?>