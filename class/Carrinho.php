<?php

// Inicializa o carrinho se ainda não existir
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
function displayCarte() {
  if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
      
      foreach ($_SESSION['cart'] as $itemId => $itemData) {
          $nomeProduto = $itemData['nomeProduto'];
          $valor = $itemData['valor'];
          $quantity = $itemData['quantity'];
          $imagePath = $itemData['imagePath'];
          echo "<tr>
                    <td>
                        <div class='product-info'>
                            <img src='". htmlspecialchars($imagePath) ."' alt='Produto 1'>
                            <span>" . htmlspecialchars($nomeProduto) ."</span>
                        </div>
                    </td>
                    <td>". number_format($valor, 2, ',', '.') ."</td>
                    <td>
                        <input type='number' value='". htmlspecialchars($quantity) . "' min='1'>
                    </td>
                    <td>" . number_format($valor, 2, ',', '.') . "</td>
                    <td>
                    <form method='POST' style='display:inline;'>
                    <input  type='hidden' name='remove' value='" . htmlspecialchars($itemId) . "'>
                    <input class='remove-btn' type='submit' value='Remover'>
                    </form>
                        
                    </td>
                </tr>";
          echo "<li>Item: " . htmlspecialchars($nomeProduto) . "
           - Quantidade: " . htmlspecialchars($quantity) . " 
           - Valor: R$ " . number_format($valor, 2, ',', '.') . "
              <form method='POST' style='display:inline;'>
                  <input type='hidden' name='remove' value='" . htmlspecialchars($itemId) . "'>
                  <input type='submit' value='Remover'>
              </form>
          </li>";
      }
 
  } else {
      echo "Seu carrinho está vazio.";
  }
}






?>