<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão apenas se não estiver ativa
}



if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Inicializa o carrinho se não existir
    $_SESSION['cartQuantidade'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Adicionar item ao carrinho
    if (isset($_POST['add_to_cart'])) {
        $itemId = $_POST['item_id'];
        $nomeProduto = $_POST['nomeProduto'];
        $valor = $_POST['valor'];
        $quantity = 1; // Adiciona 1 por padrão
        $imagePath = $_POST['imagePath'];


        if (isset($_SESSION['cart'][$itemId])) {
            // Atualiza a quantidade do item existente
            $_SESSION['cart'][$itemId]['quantity'] += $quantity;
        } else {
            // Adiciona o novo item ao carrinho
            $_SESSION['cartQuantidade'] += 1;
            $_SESSION['cart'][$itemId] = [
                'nomeProduto' => $nomeProduto,
                'valor' => $valor,
                'quantity' => $quantity,
                'imagePath' => $imagePath
            ];
        }
        echo json_encode(['success' => true, 'cartQuantidade' => $_SESSION['cartQuantidade']]);
        exit();
    }

    // Remover item do carrinho
    if (isset($_POST['remove'])) {
        $itemIdToRemove = $_POST['remove'];
        $valor = $_SESSION['cart'][$itemIdToRemove]['valor'];
        $quantidade = $_SESSION['cart'][$itemIdToRemove]['quantity'];
        $total = $valor * $quantidade;

        if (isset($_SESSION['cart'][$itemIdToRemove])) {
            unset($_SESSION['cart'][$itemIdToRemove]); // Remove o item do carrinho
            $_SESSION['cartQuantidade'] = $_SESSION['cartQuantidade'] - 1;
            if ( $_SESSION['cartQuantidade'] <= 0){
                $_SESSION['cartQuantidade'] = 0;
            }
            $_SESSION['valorFinal'] = $_SESSION['valorFinal'] - $total;
        }
        echo json_encode([
            'id' => $itemIdToRemove,
            'total' => number_format($_SESSION['valorFinal'], 2, ',', '.'), // Valor total do carrinho
            'totalItem' => number_format($total, 2, ',', '.'), // Total do item específico
            'remove' => true // Total do item específico
        ]);
        exit();
    }

    // Adicionar mais um item

    if (isset($_POST['+'])) {
        $itemIdToAdd = $_POST['+'];

        // Verifica se o item já está no carrinho
        if (isset($_SESSION['cart'][$itemIdToAdd])) {
            // Incrementa a quantidade do item
            $_SESSION['cart'][$itemIdToAdd]['quantity'] += 1;
            $valor = $_SESSION['cart'][$itemIdToAdd]['valor'];
            $quantidade = $_SESSION['cart'][$itemIdToAdd]['quantity'];
            $total = $valor * $quantidade;
            $_SESSION['valorFinal'] += $valor;
            // Retorna a nova quantidade e uma mensagem de sucesso
            echo json_encode([
                'quantidade' => $_SESSION['cart'][$itemIdToAdd]['quantity'],
                'id' => $itemIdToAdd,
                'total' => number_format($_SESSION['valorFinal'], 2, ',', '.'),
                'totalItem' => number_format($total, 2, ',', '.')
            ]);
        } else {
            // Se o item não estiver no carrinho, você pode inicializá-lo
            // Aqui está um exemplo de como inicializá-lo. Você pode ter que ajustá-lo com base na sua estrutura
            $_SESSION['cart'][$itemIdToAdd] = ['quantity' => 1];
            // Adiciona o item com quantidade 1
            // Retorna a nova quantidade e uma mensagem de sucesso
            echo json_encode([
                'quantidade' => $_SESSION['cart'][$itemIdToAdd]['quantity'],
                'id' => $itemIdToAdd,
                'total' => number_format($_SESSION['valorFinal'], 2, ',', '.'),
                'totalItem' => number_format($total, 2, ',', '.')
            ]);
        }

        exit(); // Termina a execução do script após enviar a resposta
    }

    // Remover um item
    if (isset($_POST['-'])) {
        $itemIdToRemove = $_POST['-'];
        $valor = $_SESSION['cart'][$itemIdToRemove]['valor'];
        $quantidade = $_SESSION['cart'][$itemIdToRemove]['quantity'];
        $total = $valor * $quantidade;
        // Verifica se o item existe no carrinho
        if (isset($_SESSION['cart'][$itemIdToRemove])) {
            // Verifica se a quantidade é maior que 1 antes de diminuir
            if ($_SESSION['cart'][$itemIdToRemove]['quantity'] > 1) {
                $_SESSION['cart'][$itemIdToRemove]['quantity'] -= 1; // Decrementa a quantidade
                $quantidade = $_SESSION['cart'][$itemIdToRemove]['quantity'];


                // Recalcula o total do item e o valor final do carrinho
                $total = $valor * $quantidade;
                $_SESSION['valorFinal'] = $_SESSION['valorFinal'] - $valor;
            }

            // Obtém a nova quantidade


            // Retorna a resposta JSON com a nova quantidade e o total atualizado

        }
        echo json_encode([
            'quantidade' => $quantidade, // A nova quantidade (não diminui se for 1)
            'id' => $itemIdToRemove,
            'total' => number_format($_SESSION['valorFinal'], 2, ',', '.'), // Valor total do carrinho
            'totalItem' => number_format($total, 2, ',', '.') // Total do item específico
        ]);
        exit();
    }
}
function displayQuantidade()
{
    if (!empty($_SESSION['cartQuantidade'])){
        echo $_SESSION['cartQuantidade'];
    }else{
        echo "0";
    }
    
}
function displayCarte()
{
    
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $_SESSION['valorFinal'] = 0;

        foreach ($_SESSION['cart'] as $itemId => $itemData) {
            $nomeProduto = $itemData['nomeProduto'];
            $valor = $itemData['valor'];
            $quantity = $itemData['quantity'];
            $imagePath = $itemData['imagePath'];
            $total = $valor * $quantity;
            $_SESSION['valorFinal'] += $total; // Atualiza o valor final do carrinho



            echo "<tr id=item" . htmlspecialchars($itemId) . ">
                    <td data-label='Produto' >
                        <div class='product-info'>
                            <img src='" . htmlspecialchars($imagePath) . "' alt='Produto'>
                            <span>" . htmlspecialchars($nomeProduto) . "</span>
                        </div>
                    </td>
                    <td data-label='Preço'>" . number_format($valor, 2, ',', '.') . "</td>
                    <td data-label='Quantidade' class='formatInput'>
                        <label id='quantity" . htmlspecialchars($itemId) . "' data-item-id='" . htmlspecialchars($itemId) . "'>" . htmlspecialchars($quantity) . "</label>
                        <form method='post' class='adicionarRemover'>
                            <input type='hidden' name='+' value='" . htmlspecialchars($itemId) . "'>
                            <input class='remove-btn' type='submit' value='+'>
                        </form>
                        <form method='post' class='adicionarRemover' action='Carrinho.php'>
                            <input type='hidden' name='-' value='" . htmlspecialchars($itemId) . "'>
                            <input class='remove-btn' type='submit' value='-'>
                        </form>
                    </td>
                    <td id='totalItem" . htmlspecialchars($itemId) . "' data-label='Total'>" . number_format($total, 2, ',', '.') . "</td>
                    <td data-label='Remover'>
                        <form method='POST' style='display:inline;' class='adicionarRemover' action='Carrinho.php'>
                            <input type='hidden' name='remove' value='" . htmlspecialchars($itemId) . "'>
                            <input  class='remove-btn' type='submit' value='Remover'>
                        </form>
                    </td>
                </tr>";
        }
    } else {
        $_SESSION['cartQuantidade'] = 0;
        echo "<tr><td colspan='5'>Seu carrinho está vazio.</td></tr>";
    }
}

function displayTotal()
{
    if (isset($_SESSION['valorFinal'])) {
        $finalValue = number_format($_SESSION['valorFinal'], 2, ',', '.');
    } else {
        $finalValue = number_format(0, 2);
    }

    echo "
    <div class='cart-summary'>
        <h3>Resumo do Pedido</h3>
        <p id='sub-total'>Subtotal: R$:" . $finalValue . "</p>
        <p>Frete: Grátis</p>
        <h2 id='total'>Total: R$:" . $finalValue . "</h2>
        <button class='checkout-btn'>Finalizar Compra</button>
    </div>
    ";
}
