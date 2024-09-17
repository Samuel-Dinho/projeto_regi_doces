<?php

// Inicializa o carrinho se ainda não existir
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['remove'])) {
        $itemIdToRemove = $_POST['remove'];
        // Verifica se o item existe no carrinho
        if (isset($_SESSION['cart'][$itemIdToRemove])) {
            // Remove o item do carrinho
            unset($_SESSION['cart'][$itemIdToRemove]);
            header('Location: Carrinho.php');
        }
    }
    //adiciona mais um no item;
    if (isset($_POST['+'])) {
        $itemIdToAdd = $_POST['+'];
        if (isset($_SESSION['cart'][$itemIdToAdd])) {
            $quantity = $_SESSION['cart'][$itemIdToAdd]['quantity'];
            // Atualiza a quantidade do item existente
            $_SESSION['cart'][$itemIdToAdd]['quantity'] = $quantity + 1;
            header('Location: Carrinho.php');
           
        }
    }
    if (isset($_POST['-'])) {
        $itemIdToRemove = $_POST['-'];
        if (isset($_SESSION['cart'][$itemIdToRemove])) {
            $quantity = $_SESSION['cart'][$itemIdToRemove]['quantity'];
            // Atualiza a quantidade do item existente
            $_SESSION['cart'][$itemIdToRemove]['quantity'] = $quantity - 1;
            if($quantity <= 0 ){
                unset($_SESSION['cart'][$itemIdToRemove]);
                header('Location: Carrinho.php');
            }
            header('Location: Carrinho.php');
        }
    }
}

function displayCarte() {
  if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $valorTotal = 0;
      foreach ($_SESSION['cart'] as $itemId => $itemData) {
          $nomeProduto = $itemData['nomeProduto'];
          $valor = $itemData['valor'];
          $quantity = $itemData['quantity'];
          $imagePath = $itemData['imagePath'];
          $total = $valor * $quantity;
          $valorTotal = $valor * $quantity + $valorTotal;
          echo "<tr>
                    <td>
                        <div class='product-info'>
                            <img src='". htmlspecialchars($imagePath) ."' alt='Produto 1'>
                            <span>" . htmlspecialchars($nomeProduto) ."</span>
                        </div>
                    </td>
                    <td>". number_format($valor, 2, ',', '.') ."</td>
                    <td>
                        <label type='number' value='". htmlspecialchars($quantity) . "'>
                        ". htmlspecialchars($quantity) . "</label>
                        <form method='post'>
                        <input type='hidden' value='" . htmlspecialchars($itemId) . "' name='+'></button>
                        <input class='remove-btn' type='submit' value='+'>
                        </form>
                        <form method='post'>
                        <input type='hidden' value='" . htmlspecialchars($itemId) . "' name='-'></button>
                        <input class='remove-btn' type='submit' value='-'>
                        </form>
                    </td>
                    <td>" . number_format($total, 2, ',', '.') . "</td>
                    <td>
                    <form method='POST' style='display:inline;'>
                    <input  type='hidden' name='remove' value='" . htmlspecialchars($itemId) . "'>
                    <input class='remove-btn' type='submit' value='Remover'>
                    </form>
                        
                    </td>
                </tr>";
            
      }
      
  } else {
      echo "Seu carrinho está vazio.";
  }
  $valorTotal;
  if($valorTotal <=0 )  {
    $valorTotal = 0;
  }
  echo"
        <div class='cart-summary'>
            <h3>Resumo do Pedido</h3>
            <p>Subtotal: " . number_format($valorTotal, 2, ',', '.') ."</p>
            <p>Frete: Grátis</p>
            
            <h2>Total: ". number_format($valorTotal, 2, ',', '.') ."</h2>
            <button class='checkout-btn'>Finalizar Compra</button>
        </div>
      ";
}






?>