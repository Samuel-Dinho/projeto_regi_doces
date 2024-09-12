<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Processar dados do formulário
    $nameProduto = $_POST['nameProduto'];
    $departamento = $_POST['departamento'];
    $dest_path = $_POST['arquivo'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $rotulo = $_POST['rotulo'];

    // Preparar a consulta SQL
    $stmt = $conn->prepare("INSERT INTO projeto_final.produto (prod_nome_produto, categoria_idcategoria,prod_arquivo, prod_preco, prod_descricao ,prod_rotulo) VALUES (?, ?, ?, ?, ?, ?)");
    
    // Verificar se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Vincular parâmetros
        $stmt->bind_param("sssds", $nameProduto, $departamento,$dest_path, $preco, $descricao); // "ssis" indica os tipos: string, string, int, string

        // Executar a consulta
        if ($stmt->execute()) {
            header('Location: ../admin.php');
            exit; // Certifique-se de sair após o redirecionamento
        } else {
            echo "Erro ao inserir o produto: " . $stmt->error;
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}

// Fechar conexão
$conn->close();
?>
