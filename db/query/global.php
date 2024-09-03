<?php
 require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

// Perform query
$sql = "select * from projeto_individual.produtos";
  // Free result set

  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {

    $produto = $row['idProduto'];
    $nome = $row['nameProduto'];
    $departamento = $row['departamento'];
    $valor = $row['preco'];
    $local = $row['arquivo'];
    $destaque = $row['destaque'];
    $carrosel = $row['carrosel'];

  }
  mysqli_close($conn);

 
?>
