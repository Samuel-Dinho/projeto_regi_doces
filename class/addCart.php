<?php
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['cart'])) {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date("Y-m-d");
        $idCliente = '1';
        
        
        ////Criar Numero Pedido
        $stmt = $conn->prepare("INSERT INTO projeto_final.pedido (vend_data, cliente_cl_id_cliente) VALUES (?, ?)");

        if ($stmt) {
            $stmt->bind_param("si", $data, $idCliente); // "ssis" indica os tipos: string, string, int, string
            if ($stmt->execute()) {
                $last_id = $conn->insert_id;
            } else {
                echo "Erro ao inserir o produto: " . $stmt->error;
            }
        }
        foreach ($_POST['cart'] as $itemId => $itemData) {
            $id =  $itemData['itemId'];
            $nome = $itemData['nomeProduto'];
            $preco = $itemData['valor'];
            $quantidade = $itemData['quantity'];
            echo $quantidade;
            $sql = "SELECT * FROM projeto_final.pedido WHERE vend_id_venda = " . $last_id;
            $result = mysqli_query($conn, $sql);

            $insert = $conn->prepare("INSERT INTO projeto_final.pedido_has_produto (pedido_vend_id_venda, produto_prod_id_produto,quantidade) VALUES (?, ?, ?)");
            if ($insert) {
                $insert->bind_param("iii", $last_id, $id, $quantidade); // "ssis" indica os tipos: string, string, int, string
                if ($insert->execute()) {
                } else {
                    echo "Erro ao inserir o produto: " . $insert->error;
                }
            }
        }

        $insert->close();
    }
}
