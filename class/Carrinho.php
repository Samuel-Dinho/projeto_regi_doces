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
            $quantidadeToRemove = $_SESSION['cart'][$itemIdToRemove]['quantity'];
            $_SESSION['valorFinal']  = $quantidadeToRemove - $_SESSION['valorFinal'];
            if($_SESSION['valorFinal']<= 0){
                $_SESSION['valorFinal'] = 0;
            }
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
//            header('Location: Carrinho.php');
           
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
        $_SESSION['valorFinal'] = 0;
    
    
      foreach ($_SESSION['cart'] as $itemId => $itemData) {
          $valorTotal = $_SESSION['valorFinal'];
          $nomeProduto = $itemData['nomeProduto'];
          $valor = $itemData['valor'];
          $quantity = $itemData['quantity'];
          $imagePath = $itemData['imagePath'];
          $total = $valor * $quantity;
          $_SESSION['valorFinal'] = $valor * $quantity + $valorTotal;
          echo "<tr>
                    <td data-label='Produto'>
                        <div class='product-info'>
                            <img src='". htmlspecialchars($imagePath) ."' alt='Produto 1'>
                            <span>" . htmlspecialchars($nomeProduto) ."</span>
                        </div>
                    </td>
                    <td data-label='Preço'>". number_format($valor, 2, ',', '.') ."</td>
                    <td data-label='Quantidade' class='formatInput'>
                        <label type='number' value='". htmlspecialchars($quantity) . "'>
                        ". htmlspecialchars($quantity) . "</label>
                        <form method='post' class='adicionarRemover'>
                        <input type='hidden' value='" . htmlspecialchars($itemId) . "' name='+'></button>
                        <input class='remove-btn' type='submit' value='+'>
                        </form>
                        <form method='post' class='adicionarRemover'>
                        <input type='hidden' value='" . htmlspecialchars($itemId) . "' name='-'></button>
                        <input class='remove-btn' type='submit' value='-'>
                        </form>
                    </td>
                    <td data-label='Total'>" . number_format($total, 2, ',', '.') . "</td>
                    <td data-label='Remover'>
                    <form method='POST' style='display:inline;' class='adicionarRemover'>
                    <input  type='hidden' name='remove' value='" . htmlspecialchars($itemId) . "'>
                    <input id='click' onclick='openJanelaCarrinho(". htmlspecialchars($nomeProduto) .")' class='remove-btn ' type='submit' value='Remover'>
                    </form>
                        
                    </td>
                </tr>";


            
      }
      
  } else {
      echo "Seu carrinho está vazio.";
  }
  
//   isset

      
}

function displayTotal(){
    $finalValue = $_SESSION['valorFinal'] ? number_format($_SESSION['valorFinal'], 2) : 0;
    echo"
    <div class='cart-summary'>
        <h3>Resumo do Pedido</h3>
        <p>Subtotal: " . $finalValue ."</p>
        <p>Frete: Grátis</p>
        <h2>Total: ". $finalValue. "</h2>
        <button class='checkout-btn'>Finalizar Compra</button>
    </div>
    ";
}





