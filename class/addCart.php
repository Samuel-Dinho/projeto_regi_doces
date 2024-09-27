<?php
require '../db/db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    // Inicia a sessão apenas se não estiver ativa
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['cart'])) {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date("Y-m-d");
        $idCliente = 3;
        
        // Criar Número do Pedido
        $stmt = $conn->prepare("INSERT INTO projeto_final.pedido (vend_data, cl_id) VALUES (?, ?)");

        if ($stmt) {
            $stmt->bind_param("si", $data, $idCliente); // "si" (string, int) corresponde aos tipos corretos
            if ($stmt->execute()) {
                $last_id = $conn->insert_id; // Pegar o ID gerado pela inserção do pedido
                $stmt->close(); // Fechar o statement após a inserção
            } else {
                echo "Erro ao inserir o pedido: " . $stmt->error;
                $stmt->close();
                exit(); // Saia para evitar continuar o processo sem o número do pedido
            }
        } else {
            echo "Erro ao preparar a inserção do pedido: " . $conn->error;
            exit(); // Saia do processo em caso de erro ao preparar
        }

        // Inserir os itens do carrinho
        foreach ($_POST['cart'] as $itemId => $itemData) {
            $id = $itemData['itemId'];
            $nome = $itemData['nomeProduto'];
            $preco = $itemData['valor'];
            $quantidade = $itemData['quantity'];
            print_r ($quantidade);

            // Inserir item no pedido_has_produto
            $insert = $conn->prepare("INSERT INTO projeto_final.pedido_has_produto (id_pedido, id_produto, quantidade) VALUES (?, ?, ?)");
            if ($insert) {
                $insert->bind_param("iii", $last_id, $id, $quantidade); // Todos os três valores são inteiros
                if ($insert->execute()) {
                    // Inserção bem-sucedida, você pode adicionar mais lógica aqui se necessário
                } else {
                    echo "Erro ao inserir o produto no pedido: " . $insert->error;
                }
                $insert->close(); // Fechar o statement de inserção para liberar recursos
            } else {
                echo "Erro ao preparar a inserção do produto: " . $conn->error;
            }
        }
    }
    $_SESSION['cart'] = [];
}


